import { Nullable } from '@/typings/common';

export type FileUploadScenario = 'default' | 'product' | 'product-preset';

export type ImageType = {
  id: number;
  url: string;
};

export type Preset = {
  id: number;
  name: string;
  image: Nullable<string>;
  isNew: boolean;
  isPopular: boolean;
  presetsCount: number;
  presetsCountText: string;
  description: string;
  websiteUrl: string;
  price: number;
  discountPrice: Nullable<number>;
  reviewsCount: number;
  urlAlias: string;
  coverImage: Nullable<ImageType>;
  images: Array<{ before: ImageType; after: ImageType }>;
};

export type PresetReview = {
  id: number;
  author: string;
  title: string;
  text: string;
  mark: number;
  date: string;
};
