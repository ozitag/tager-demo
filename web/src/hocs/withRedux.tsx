import React from 'react';
import { NextComponentType } from 'next';

import { AppStore, createStore } from '@store/store';
import {
  CustomAppContext,
  CustomAppInitialProps,
  CustomAppProps,
  ReduxAppContext,
  ReduxAppInitialProps,
  ReduxAppProps,
} from '@typings/hocs';

declare global {
  interface Window {
    __NEXT_REDUX_STORE__?: AppStore;
  }
}

const config = {
  storeKey: '__NEXT_REDUX_STORE__',
  debug: false,
} as const;

type CustomAppType = NextComponentType<
  CustomAppContext,
  CustomAppInitialProps,
  CustomAppProps
>;

function withRedux(CustomApp: CustomAppType) {
  const isServer = typeof window === 'undefined';

  /** Create Redux store */
  function initStore({ initialState }: { initialState?: any } = {}): AppStore {
    const { storeKey } = config;

    if (isServer) return createStore(initialState);

    /** Memoize store if client */
    let memoizedStore = window[storeKey];

    if (!memoizedStore) {
      memoizedStore = createStore(initialState);
      window[storeKey] = memoizedStore;
    }

    return memoizedStore;
  }

  const componentName = CustomApp.displayName || CustomApp.name || 'App';

  class ReduxApp extends React.Component<ReduxAppProps> {
    public static displayName = `withRedux(${componentName})`;

    public static getInitialProps = async (
      appCtx: ReduxAppContext
    ): Promise<ReduxAppInitialProps> => {
      if (!appCtx) throw new Error('No app context');
      if (!appCtx.ctx) throw new Error('No page context');

      const store = initStore();

      if (config.debug) {
        console.log(
          '1. WrappedApp.getInitialProps wrapper got the store with state',
          store.getState()
        );
      }

      if (typeof CustomApp.getInitialProps !== 'function') {
        throw new Error(
          `Component "${componentName}" doesn't have required static field "getInitialProps"`
        );
      }

      const initialProps = await CustomApp.getInitialProps({
        ...appCtx,
        ctx: { ...appCtx.ctx, isServer, store },
      });

      if (config.debug) {
        console.log(
          '3. WrappedApp.getInitialProps has store state',
          store.getState()
        );
      }

      return {
        isServer,
        initialState: store.getState(),
        ...initialProps,
      };
    };

    public constructor(props: ReduxAppProps, context: any) {
      super(props, context);

      const { initialState } = props;

      if (config.debug)
        console.log(
          '4. WrappedApp.render created new store with initialState',
          initialState
        );

      this.store = initStore({
        initialState,
      });
    }

    protected store: AppStore;

    public render() {
      const { initialState, ...props } = this.props;
      return <CustomApp {...props} store={this.store} />;
    }
  }

  return ReduxApp;
}

export default withRedux;
