import { Nullable } from '@/typings/common';

class StorageService {
  private storage: Storage;

  constructor(storage: Storage) {
    this.storage = storage;
  }

  get(field: string): Nullable<string> {
    return this.storage.getItem(field);
  }

  getJSON<T>(field: string): Nullable<T> {
    const value = this.get(field);

    if (value === null) return value;

    try {
      return JSON.parse(value);
    } catch(error) {
      console.error(`Storage service error while parsing field: "${field}"`, error);
      return null;
    }
  }

  set(key: string, value: any): void {
    const stringifiedValue = typeof value === 'string' ? value : JSON.stringify(value);
    this.storage.setItem(key, stringifiedValue);
  }
}

export const localStorageService = new StorageService(localStorage);
export const sessionStorageService = new StorageService(sessionStorage);