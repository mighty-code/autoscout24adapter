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
            'label' => 'Ihre HCI Listen URL',
            'commentAbove' => 'Kopieren Sie den URL aus dem Attribut data-embedded-src welcher hier gefunden werden kann: https://www.autoscout24.ch/de/member/hci'
        ]
    ]
    ,
    'list' => [
        'details' => 'Mehr erfahren',
        'confirm' => 'OK',
        'color' => 'Farbe',
        'mileage' => 'Kilometerstand',
        'year' => 'Jahrgang',
        'price' => 'Preis'
    ]
];