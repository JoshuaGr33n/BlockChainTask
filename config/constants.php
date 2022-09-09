<?php
return [

    'image' => [
        'default' => 'assets/images/default.png',
    ],

    'admin' => [
        'profile' => [
            'path' => 'assets/admin/images/profile',
            'size' => '150x150',
        ],
    ],

    'language' => [
        'path' => 'assets/images/lang',
        'size' => '32x21'
    ],

    'withdraw' => [
        'method' => [
            'path' => 'assets/images/withdraw/method',
            'size' => '120x120',
        ],
        'verify' => [
            'path' => 'assets/images/verify_withdraw'

        ]
    ],
    'deposit' => [
        'gateway' => [
            'path' => 'assets/images/gateway',
            'size' => '200x200',
        ],
        'verify' => [
            'path' => 'assets/images/verify_deposit'

        ]
    ],

    'logoIcon' => [
        'path' => 'assets/images/logoIcon',
    ],

    'favicon' => [
        'size' => '128x128',
    ],

    'user' => [
        'profile' => [
            'path' => 'assets/images/user/profile',
            'size' => '150x150',
        ]
    ],

    'chat' => [
        'image' => [
            'path' => 'assets/images/kyc',
            'size' => '150x150',
        ]
    ],
    'table' => [
        'default' => 15,
        'preview' => 6,
    ],
    'currency' => [
        'precision' => [
            'crypto' => 8,
            'fiat' => 2,
        ],
        'base' => 'fiat',

    ],

    'seo' => [
        'path' => 'assets/images/seo',
        'size' => '600x315',
    ],

    'plugin' => [
        'path' => 'assets/images/plugin',
    ],
    'stringLimit' => [
        'default' => 40,
    ],

    'frontend' => [
        'blog' => [
            'post' => [
                'path' => 'assets/images/frontend/blog',
                'size' => '728x465',
                'thumb' => '90x60',
            ],
        ],
        'seo' => [
            'path' => 'assets/images/frontend/seo',
            'size' => '600x315',
        ],
        'testimonial' => [
            'path' => 'assets/images/frontend/testimonial',
            'size' => '500x440',
        ],
        'services' => [
            'path' => 'assets/images/frontend/services',
            'size' => '60x60',
        ],
        'about' => [
            'path' => 'assets/images/frontend/about',
            'size' => '720x540',
        ],
        'profit' => [
            'path' => 'assets/images/frontend/profit',
            'size' => '40x40',
            'caption'=>[
                'path' => 'assets/images/frontend/profit',
            ]
        ],
        'feature' => [
            'path' => 'assets/images/frontend/feature',
            'size' => '40x40',
            'caption'=>[
                'path' => 'assets/images/frontend/feature',
            ]
        ]

    ],
];
