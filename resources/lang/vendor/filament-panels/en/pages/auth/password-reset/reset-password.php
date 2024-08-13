<?php

return [

    'title' => 'خپل پټ نوم ریسټ کړی',

    'heading' => 'خپل پټ نوم ریسټ کړی',

    'form' => [

        'email' => [
            'label' => 'ایمیل آدرس',
        ],

        'password' => [
            'label' => 'پټ نوم',
            'validation_attribute' => 'یو ځل بیا پټ نوم ولیکی',
        ],

        'password_confirmation' => [
            'label' => 'پټ نوم مو تایید کړی',
        ],

        'actions' => [

            'reset' => [
                'label' => 'پټ نوم ریسټ کړی',
            ],

        ],

    ],

    'notifications' => [

        'throttled' => [
            'title' => 'ډیر زیات کوښښ مو وکړ',
            'body' => 'مهربانی وکړی :seconds ثانیی صبر وکړی.',
        ],

    ],

];
