export type ColumnDefinition = {
  id: number;
  name: string;
  field: string;
  type?: 'string' | 'date' | 'image' | 'link';
  format?: (
    value: any,
    row: { [key: string]: any },
    column: ColumnDefinition
  ) => string;
  getLinkLabel?: (
    row: { [key: string]: any },
    column: ColumnDefinition
  ) => string;
  getLinkHref?: (
    row: { [key: string]: any },
    column: ColumnDefinition
  ) => string;
};
