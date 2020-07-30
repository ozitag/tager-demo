<?php

return [
    'debug' => env('TAGER_MAIL_DEBUG'),
    'templates' => [
        \App\Enums\EmailTemplate::Contact => [
            'name' => 'Contact form',
            'templateParams' => [
                'name' => 'Name',
                'email' => 'E-Mail',
                'message' => 'Message'
            ],
            'subject' => 'New contact form request',
            'body' => '<p><b>Name:</b> {{name}}</p><p><b>E-mail:</b> {{email}}</p><p><b>Message:</b> {{message}}</p>',
            'recipients' => [
                'v.ozierski@ozitag.com'
            ],
        ]
    ]
];
