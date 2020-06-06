<?php

$validator = [
    'maxSize' => 20 * 1024 * 1024,
    'checkExtensionByMimeType' => true,
    'extensions' => ['jpg', 'jpeg', 'png']
];

function fileStorage($folder)
{
    return [
        'type' => 'file',
        'saveOriginalFilename' => false,
        'uploadDirPath' => __DIR__ . '/../storage/app/public/default/' . $folder,
        'uploadDirUrl' => '/uploads/' . $folder,
    ];
}

return [
    'scenarios' => [
        'default' => [
            'storage' => fileStorage('default'),
            'validator' => $validator,
            'thumbnails' => [
                'preview' => [
                    'width' => 380,
                    'height' => 250,
                    'crop' => true,
                    '2x' => true,
                    'webp' => true,
                    'quality' => 100
                ],
                'og' => [
                    'width' => 1200,
                    'height' => 630,
                    'exact' => true
                ],
            ]
        ],
    ]
];
