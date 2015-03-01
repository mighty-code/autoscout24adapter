<?php
return [
    'plugin' => [
        'name' => 'Autoscout24 Adapter',
        'description' => 'Listen Sie Ihre Inserate von Autoscout 24 direkt auf der Webseite auf.'
    ],
    'settings' => [
        'label' => 'Autoscout 24 Adapter',
        'description' => 'Einstellung der Client ID',
        'fields' => [
            'label' => 'Ihre Client ID',
            'commentAbove' => 'Sie finden Ihre Client ID in Ihrem autoscout24.ch Account. (Beispiel: 61584)'
        ]
    ]
    ,
    'list' => [
        'details' => 'Details',
        'confirm' => 'OK',
        'color' => 'Farbe',
        'mileage' => 'Kilometerstand',
        'year' => 'Jahrgang',
        'price' => 'Preis'
    ]
];