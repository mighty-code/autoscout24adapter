<?php namespace MightyCode\Autoscout24Adapter\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

/**
 * Views Back-end Controller
 */
class Views extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('MightyCode.Autoscout24Adapter', 'autoscout24adapter', 'views');
    }
}