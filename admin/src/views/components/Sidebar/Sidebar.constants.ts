type MenuItemType = {
  id: string;
  name: string;
  path: string;
  iconClass: string;
  children?: Array<{ name: string; path: string }>;
};

export const MENU_ITEM_LIST: Array<MenuItemType> = [
  {
    name: 'Заказы',
    iconClass: 'ni ni-box-2 text-primary',
    path: '/admin/orders',
    id: 'orders',
    children: [
      {
        path: '/admin/orders/pending',
        name: 'В ожидании'
      },
      {
        path: '/admin/orders/active',
        name: 'Активные'
      },
      {
        path: '/admin/orders/archive',
        name: 'Архивные'
      },
      {
        path: '/admin/orders/export',
        name: 'Экспорт'
      }
    ]
  },
  {
    name: 'Каталог',
    iconClass: 'ni ni-archive-2 text-primary',
    id: 'catalog',
    path: '/admin/catalog',
    children: [
      {
        path: '/admin/products',
        name: 'Товары'
      },
      {
        path: '/admin/categories',
        name: 'Категории'
      },
      {
        path: '/admin/types',
        name: 'Типы товаров'
      },
      {
        path: '/admin/gifts',
        name: 'Подарки'
      }
    ]
  },
  {
    name: 'Справочники',
    iconClass: 'ni ni-books text-primary',
    id: 'books',
    path: '/admin/info',
    children: [
      {
        path: '/admin/ingredients',
        name: 'Ингредиенты'
      },
      {
        path: '/admin/wraps',
        name: 'Упаковки'
      }
    ]
  },
  {
    id: 'sliders',
    name: 'Слайдеры',
    iconClass: 'ni ni-palette text-primary',
    path: '/admin/sliders'
  },
  {
    id: 'faq',
    name: 'Вопрос - ответ',
    iconClass: 'ni ni-collection text-primary',
    path: '/admin/faq'
  },
  {
    id: 'shops',
    name: 'Магазины',
    iconClass: 'ni ni-shop text-primary',
    path: '/admin/shops'
  },
  {
    id: 'settings',
    name: 'Настройки',
    iconClass: 'ni ni-ui-04',
    path: '/admin/settings'
  }
];
