import { MetaHTMLAttributes } from 'react';

import { getAbsoluteUrl, notEmpty } from '@utils/common';
import { parseUrl } from '@utils/searchParams';

/**
 * References:
 * 1. https://support.google.com/webmasters/answer/139066
 * 2. https://yoast.com/rel-canonical/
 */
export function getCanonicalUrl(currentPath: string, canonicalPath?: string) {
  const absoluteUrl = getAbsoluteUrl(canonicalPath ?? currentPath);

  const parsedUrl = parseUrl(absoluteUrl);

  /** Remove hash from url */
  return parsedUrl
    ? parsedUrl.origin + parsedUrl.pathname + parsedUrl.search
    : absoluteUrl;
}

export function getLdJsonData(
  currentPath: string,
  title?: string,
  description?: string,
  image?: string,
  datePublished?: string,
  dateModified?: string,
  organizationName?: string,
  logoSrc?: string
) {
  const currentUrl = getAbsoluteUrl(currentPath);

  const result: any = {
    '@context': 'http://schema.org',
    '@type': 'WebPage',
  };

  if (title) {
    result.name = title;
  }

  if (description) {
    result.description = description;
  }

  if (image) {
    result.image = [getAbsoluteUrl(image)];
  }

  if (datePublished) {
    result.datePublished = datePublished;
  }

  if (dateModified) {
    result.dateModified = dateModified;
  }

  if (organizationName) {
    result.publisher = {
      '@type': 'Organization',
      name: organizationName,
    };

    if (process.env.REACT_APP_ORIGIN) {
      result.publisher.url = process.env.REACT_APP_ORIGIN;
    }

    if (logoSrc) {
      result.publisher.logo = {
        '@type': 'ImageObject',
        url: [getAbsoluteUrl(logoSrc)],
      };
    }
  }

  if (currentUrl) {
    result.mainEntityOfPage = {
      '@type': 'WebPage',
      '@id': getAbsoluteUrl(currentUrl),
    };
  }

  return result;
}

export function getMetaList({
  title,
  description,
  image,
  currentPath,
}: {
  title?: string;
  description?: string;
  image?: string;
  currentPath: string;
}): Array<MetaHTMLAttributes<HTMLMetaElement>> {
  const currentPageUrl = getAbsoluteUrl(currentPath);

  return [
    /**
     * HTML Living Standard
     * The definition of '<meta>' in that specification.
     * https://html.spec.whatwg.org/multipage/semantics.html#the-meta-element
     */
    {
      name: 'copyright',
      content: 'OZiTAG LLC',
    },
    {
      name: 'author',
      content: 'OZiTAG, ozitag.com',
    },
    description
      ? {
          name: 'description',
          content: description,
        }
      : null,

    /**
     * Metadata for Open Graph protocol
     * Reference: https://ogp.me/
     */

    currentPageUrl
      ? {
          name: 'og:url',
          content: currentPageUrl,
        }
      : null,

    title
      ? {
          property: 'og:title',
          content: title,
        }
      : null,
    description
      ? {
          property: 'og:description',
          content: description,
        }
      : null,

    image
      ? {
          property: 'og:image',
          content: getAbsoluteUrl(image),
        }
      : null,

    {
      property: 'og:type',
      content: 'website',
    },

    /**
     * Metadata for Twitter cards
     * Reference: https://developer.twitter.com/en/docs/tweets/optimize-with-cards/overview/markup
     */
    {
      name: 'twitter:card',
      content: 'summary',
    },
    {
      name: 'twitter:creator',
      content: 'OZiTAG, ozitag.com',
    },
    title
      ? {
          name: 'twitter:title',
          content: title,
        }
      : null,
    description
      ? {
          name: 'twitter:description',
          content: description,
        }
      : null,
  ].filter(notEmpty);
}
