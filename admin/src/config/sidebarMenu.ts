export type MenuItemType = {
  id: string;
  name: string;
  path: string;
  icon: string;
  isOpen?: boolean;
  children?: Array<{ name: string; path: string }>;
};

export const MENU_ITEM_LIST: Array<MenuItemType> = [];
