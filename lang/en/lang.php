<?php
return [
    'plugin' => [
        'name' => 'Autoscout24 Adapter',
        'description' => 'Get access of your autoscout24.ch ads.'
    ],
    'settings' => [
        'label' => 'Autoscout 24 Adapter',
        'description' => 'Set HCI list URL.',
        'fields' => [
            'label' => 'Your autoscout24.ch HCI List URL',
            'commentAbove' => 'Copy the full URL of the data-embedded-src attribute you can find here: https://www.autoscout24.ch/de/member/hci'
        ]
    ],
    'list' => [
        'details' => 'Details',
        'confirm' => 'OK',
        'color' => 'Color',
        'mileage' => 'Mileage',
        'year' => 'Year',
        'price' => 'Price'
    ]
];