import React, { useEffect } from 'react';
import { NextComponentType } from 'next';
import { Router } from 'next/router';

import FacebookPixel from '@services/facebookPixel';

function withFacebookPixel(NextComponent: NextComponentType<any, any, any>) {
  function FacebookPixelHOC(props: any) {
    useEffect(() => {
      const facebookPixel = new FacebookPixel();
      if (!facebookPixel.isTrackerEnabled()) return;

      facebookPixel.init();
      facebookPixel.trackPageView();

      Router.events.on('routeChangeComplete', () => {
        facebookPixel.trackPageView();
      });
    }, []);

    return <NextComponent {...props} />;
  }

  if (NextComponent.getInitialProps) {
    FacebookPixelHOC.getInitialProps = NextComponent.getInitialProps;
  }

  FacebookPixelHOC.displayName = 'withFacebookPixel';

  return FacebookPixelHOC;
}

export default withFacebookPixel;
