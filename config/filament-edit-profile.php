<?php

return [
    'show_custom_fields' => true,
    'custom_fields' => [
        'custom_field_1' => [
            'type' => 'text',
            'label' => 'Custom Textfield 1',
            'placeholder' => 'Custom Field 1',
            'required' => true,
            'rules' => 'required|string|max:255',
        ],
        'custom_field_2' => [
            'type' => 'password',
            'label' => 'Custom Password field 2',
            'placeholder' => 'Custom Password Field 2',
            'required' => true,
            'rules' => 'required|string|max:255',
        ],
        'custom_field_3' => [
            'type' => 'select',
            'label' => 'Custom Select 3',
            'placeholder' => 'Select',
            'required' => true,
            'options' => [
                'option_1' => 'Option 1',
                'option_2' => 'Option 2',
                'option_3' => 'Option 3',
            ],
        ],
        'custom_field_4' => [
            'type' => 'textarea',
            'label' => 'Custom Textarea 4',
            'placeholder' => 'Textarea',
            'rows' => '3',
            'required' => true,
        ],
        'custom_field_5' => [
            'type' => 'datetime',
            'label' => 'Custom Datetime 5',
            'placeholder' => 'Datetime',
            'seconds' => false,
        ],
        'custom_field_6' => [
            'type' => 'boolean',
            'label' => 'Custom Boolean 6',
            'placeholder' => 'Boolean'
        ],
    ]
];
