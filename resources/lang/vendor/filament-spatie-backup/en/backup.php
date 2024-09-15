<?php

return [
    'components' => [
        'backup_destination_list' => [
            'table' => [
                'actions' => [
                    'download' => 'ډنلوډ',
                    'delete' => 'حذف',
                ],

                'fields' => [
                    'path' => 'د ثبت ځای یی',
                    'disk' => 'د ذخیری ځای',
                    'date' => 'نیټه',
                    'size' => 'مقدار',
                ],

                'filters' => [
                    'disk' => 'د ذخیری ځای',
                ],
            ],
        ],

        'backup_destination_status_list' => [
            'table' => [
                'fields' => [
                    'name' => 'نوم',
                    'disk' => 'د ذخیری ځای',
                    'healthy' => 'روغتیا',
                    'amount' => 'تعداد',
                    'newest' => 'اخیری بک اپ',
                    'used_storage' => 'اشغال شوی حافظه',
                ],
            ],
        ],
    ],

    'pages' => [
        'backups' => [
            'actions' => [
                'create_backup' => 'نوی بیک اپ',
            ],

            'heading' => 'د بیک اپ لیست',

            'messages' => [
                'backup_success' => 'ستاسی بک اپ روان دی په سیستم کی',
                'backup_delete_success' => 'بک اپ حذف کول روان دی په سیستم کی',
            ],

            'modal' => [
                'buttons' => [
                    'only_db' => 'یوازی د ډیټابیس',
                    'only_files' => 'یوازی د اسنادو',
                    'db_and_files' => 'د دواړو هم د اسنادو هم د ډیټابیس',
                ],

                'label' => 'Please choose an option',
            ],

            'navigation' => [
                'label' => 'بیک اپ',
            ],
        ],
    ],

];
