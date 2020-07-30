<?php

use Ozerich\FileStorage\Utils\ConfigHelper;
use App\Enums\FileScenario;
use App\Enums\Thumbnail;

return [
    'defaultStorage' => ConfigHelper::temporaryStorage(),
    'defaultValidator' => ConfigHelper::defaultValidator(),

    'scenarios' => [
        FileScenario::File => [
            'storage' => ConfigHelper::fileStorage('zip')
        ],
        FileScenario::Product => [
            'storage' => ConfigHelper::fileStorage('products'),
            'thumbnails' => [
                Thumbnail::Preview => ConfigHelper::thumbWithWebpAnd2x(380, 250),
                Thumbnail::OpenGraph => ConfigHelper::thumbOpenGraph(),
            ]
        ],
    ]
];
