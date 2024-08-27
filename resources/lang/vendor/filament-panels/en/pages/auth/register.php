<?php

return [

    'title' => 'ثبت نام',

    'heading' => 'نوم لیکنه',

    'actions' => [

        'login' => [
            'before' => 'یا هم ',
            'label' => 'خپل حساب ته مو د ننه شی',
        ],

    ],

    'form' => [

        'email' => [
            'label' => 'ایمیل آدرس',
        ],

        'name' => [
            'label' => 'نوم',
        ],

        'password' => [
            'label' => 'پټ نوم',
            'validation_attribute' => 'پټ نوم',
        ],

        'password_confirmation' => [
            'label' => 'پټ نوم تایید کړی',
        ],

        'actions' => [

            'register' => [
                'label' => 'نوم لیکنه',
            ],

        ],

    ],

    'notifications' => [

        'throttled' => [
            'title' => 'څو ځله اشتباه کوښښ',
            'body' => 'مهربانی وکړی صبر وکړی :seconds ثانیی.',
        ],

    ],

];
