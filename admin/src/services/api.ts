import { ConstantMap } from '@/typings/common';
import { localStorageService } from '@/services/storage';

type HttpMethod = 'GET' | 'POST' | 'PUT' | 'DELETE' | 'PATCH';

const HttpMethods: ConstantMap<HttpMethod> = {
  GET: 'GET',
  POST: 'POST',
  PUT: 'PUT',
  DELETE: 'DELETE',
  PATCH: 'PATCH',
};

type QueryParams = { [key: string]: any };

export type ParsedResponseBody =
  | boolean
  | string
  | { [key: string]: any }
  | null
  | undefined;

export class RequestError extends Error {
  status: { code: number; text: string };
  body: ParsedResponseBody;

  constructor(
    status: { code: number; text: string },
    body: ParsedResponseBody
  ) {
    super(JSON.stringify({ status, body }, null, 2));

    this.status = status;
    this.body = body;

    console.error(this);
  }
}

class ApiService {
  getAccessToken() {
    return localStorageService.get('accessToken');
  }

  configureHeaders(body?: BodyInit): Headers {
    const headers = new Headers();

    const isFormData = body instanceof FormData;
    if (!isFormData) {
      headers.set('Content-Type', 'application/json');
    }

    const accessToken = this.getAccessToken();

    if (accessToken) {
      headers.set('Authorization', `JWT ${accessToken}`);
    }

    headers.set('Accept', 'application/json');

    return headers;
  }

  configureBody(body?: BodyInit): BodyInit | null {
    if (!body) return null;

    if (body instanceof FormData) {
      return body;
    }

    return JSON.stringify(body);
  }

  getSearchParams(params?: QueryParams): string {
    if (!params || Object.keys(params).length === 0) return '';

    const searchParams = new URLSearchParams();

    Object.entries(params).forEach(([key, value]) =>
      searchParams.append(key, value)
    );

    return `?${searchParams.toString()}`;
  }

  getRequestUrl(path = '', params?: QueryParams) {
    const searchParams = this.getSearchParams(params);
    return [process.env.REACT_APP_API_URL, path, searchParams]
      .filter(Boolean)
      .join('');
  }

  configureOptions({
    method,
    body,
    fetchOptions,
  }: {
    method: HttpMethod;
    body?: BodyInit;
    fetchOptions?: RequestInit;
  }): RequestInit {
    return {
      headers: this.configureHeaders(body),
      method,
      mode: 'cors',
      body: this.configureBody(body),
      ...fetchOptions,
    };
  }

  getContent(response: Response) {
    const contentType = response.headers.get('content-type');

    if (contentType && contentType.startsWith('application/json')) {
      return response.json().catch((error) => {
        /** empty json body will throw "SyntaxError: Unexpected end of input" */
        if (error instanceof SyntaxError) {
          return response.text();
        } else {
          console.error(
            `Unknown error while parsing response body: ${error.toString()}`
          );
        }
      });
    }

    return response.text();
  }

  handleErrors(response: Response) {
    return this.getContent(response).then((content) => {
      if (response.ok) {
        return content;
      }

      return Promise.reject(
        new RequestError(
          {
            code: response.status,
            text: response.statusText,
          },
          content
        )
      );
    });
  }

  logRequest(res: Response, options: RequestInit): Response {
    const formattedLog = `${options.method} ${res.status} ${res.url}`;
    console.log(`%c ${formattedLog}`, 'color: green');
    return res;
  }

  async makeRequest(
    method: HttpMethod,
    {
      path,
      body,
      params,
      absoluteUrl,
      fetchOptions,
    }: {
      path?: string;
      body?: BodyInit;
      params?: QueryParams;
      absoluteUrl?: string;
      fetchOptions?: RequestInit;
    }
  ) {
    const url = absoluteUrl || this.getRequestUrl(path, params);
    const options = this.configureOptions({ method, body, fetchOptions });

    return fetch(url, options)
      .then((response) => this.logRequest(response, options))
      .then(this.handleErrors.bind(this));
  }

  bindHttpMethod(method: HttpMethod) {
    return this.makeRequest.bind(this, method);
  }
}

const api = new ApiService();

export const get = api.bindHttpMethod(HttpMethods.GET);
export const post = api.bindHttpMethod(HttpMethods.POST);
export const put = api.bindHttpMethod(HttpMethods.PUT);
export const del = api.bindHttpMethod(HttpMethods.DELETE);
export const patch = api.bindHttpMethod(HttpMethods.PATCH);

export default api;
