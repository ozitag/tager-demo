import { Route, RouteConfig } from 'vue-router';

export type Option<V = string> = {
  value: V;
  label: string;
};

export type Nullable<T> = T | null;

export type Nullish<T> = T | null | undefined;

export type ConstantMap<C extends string> = Readonly<Record<C, C>>;

export type FetchStatus = 'IDLE' | 'LOADING' | 'SUCCESS' | 'FAILURE';

export type LoadableData<T, E = string> = {
  data: T;
  status: FetchStatus;
  error: Nullable<E>;
};

export type ErrorsMap = { [key: string]: { code: string; message: string } };

export type ResponseBody<Data> = {
  data: Data;
  errors?: ErrorsMap;
};

export type SidebarMenuItemType = {
  id: string;
  name: string;
  path: string;
  icon: string;
  isOpen?: boolean;
  children?: Array<{ name: string; path: string }>;
};

export type LogoConfig = {
  logo: Nullable<string>;
  label: Nullable<string>;
  'label-color': Nullable<string>;
};

export type BrandConfig = {
  small: LogoConfig;
  large: LogoConfig;
};

export type Breadcrumb = { path: string; label: string };

export type RouteMeta = {
  getBreadcrumbs: (route: Route) => Array<Breadcrumb>;
};

export type CustomRouteConfig = Omit<RouteConfig, 'meta'> & {
  meta?: RouteMeta;
};
