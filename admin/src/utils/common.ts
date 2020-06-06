import round from 'lodash/round';

import { ErrorsMap, LoadableData, Nullable } from '@/typings/common';
import { FETCH_STATUSES } from '@/constants/common';
import { RequestError } from '@tager/admin-core';

function getNumberSign(value: number): string {
  return value === 0 ? '' : value > 0 ? '+' : '-';
}

/** 12345678 => "12 345 678" */
export function formatNumber(
  value: number,
  options?: { precision?: number; withSign?: boolean }
): string {
  let result =
    typeof options?.precision === 'number'
      ? round(value, options.precision).toFixed(options.precision)
      : value.toString();

  result = result.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1 ').replace('.', ',');

  if (options?.withSign) {
    result = getNumberSign(value) + result;
  }

  return result;
}

export function generateNumberArray(length: number): Array<number> {
  return Array.from({ length }, (_, index) => index);
}

export function isStringGuard(value: any): value is string {
  return typeof value === 'string';
}

export function isObjectGuard(value: any): value is object {
  return typeof value === 'object';
}

export function isNonNullObjectGuard(
  value: any
): value is { [key: string]: any } {
  return isObjectGuard(value) && Boolean(value);
}

function isEnum<T extends string>(value: any, enumArray: Array<T>): value is T {
  return enumArray.includes(value);
}

export function notEmpty<TValue>(
  value: TValue | null | undefined
): value is TValue {
  return value !== null && value !== undefined;
}

export function convertSrcSet(sources: Array<string>): string {
  return sources
    .slice(0, 2)
    .map((url, index) => `${url} ${index + 1}x`)
    .join(', ');
}

export function getImageTypeFromUrl(url: string | null): string | null {
  if (!url) return null;

  const dotPositionIndex = url.lastIndexOf('.');

  if (dotPositionIndex === -1) return null;

  const extension = url.slice(dotPositionIndex + 1);

  switch (extension) {
    case 'svg':
      return 'image/svg+xml';
    case 'webp':
      return 'image/webp';
    case 'png':
      return 'image/png';
    case 'jpg':
    case 'jpeg':
      return 'image/jpeg';
  }

  return null;
}

export function createResourceLoader<DataType>(initialData: DataType) {
  return {
    getInitialResource(): LoadableData<DataType> {
      return {
        data: initialData,
        status: FETCH_STATUSES.IDLE,
        error: null
      };
    },
    pending(): LoadableData<DataType> {
      return {
        data: initialData,
        status: FETCH_STATUSES.LOADING,
        error: null
      };
    },
    fulfill(payload: DataType): LoadableData<DataType> {
      return {
        data: payload,
        status: FETCH_STATUSES.SUCCESS,
        error: null
      };
    },
    reject(error?: Nullable<string>): LoadableData<DataType> {
      return {
        data: initialData,
        status: FETCH_STATUSES.FAILURE,
        error: error ?? null
      };
    }
  };
}

export function trimEndSlash(url: string): string {
  return url.endsWith('/') ? url.slice(0, -1) : url;
}

export function getOrigin(): string {
  return trimEndSlash(process.env.REACT_APP_ORIGIN ?? '');
}

export function isAbsoluteUrl(url: string): boolean {
  return ['https:', 'http:'].some(protocol => url.startsWith(protocol));
}

export function getAbsoluteUrl(urlOrPath: string): string {
  if (isAbsoluteUrl(urlOrPath)) return urlOrPath;

  return getOrigin() + urlOrPath;
}

export function convertRequestErrorToFormErrors(
  error: Error
): Record<string, string> {
  if (error instanceof RequestError) {
    const responseBody = error.body as { errors: ErrorsMap };

    if (responseBody.errors) {
      return Object.keys(responseBody.errors).reduce<Record<string, string>>(
        (result, key) => {
          const error = responseBody.errors && responseBody.errors[key];
          result[key] = error?.message ?? '';
          return result;
        },
        {}
      );
    }
  }

  return {};
}

export function convertStringToNumberIfValid(value: string): number | string {
  const parsedNumber = Number(value.trim());

  return Number.isNaN(parsedNumber) ? value : parsedNumber;
}
