export function formatDate(date: Date): string {
  return date.toLocaleDateString();
}

export function formatDateTime(date: Date): string {
  return date.toLocaleString();
}

export function formatTime(date: Date): string {
  return date.toLocaleTimeString();
}

export function formatBoolean(value: any): string {
  return value ? 'Yes' : 'No';
}
