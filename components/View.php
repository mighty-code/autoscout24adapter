<?php namespace MightyCode\Autoscout24Adapter\Components;

use Cms\Classes\ComponentBase;
use MightyCode\Autoscout24Adapter\Models\CarInfo;

class View extends ComponentBase
{

    public function componentDetails()
    {
        return [
            'name' => 'View Component',
            'description' => 'No description provided yet...'
        ];
    }

    public function defineProperties()
    {
        return [
            'maxItems' => [
                'title' => 'Max items',
                'description' => 'The most amount of ad items allowed',
                'default' => 10,
                'type' => 'string',
                'validationPattern' => '^[0-9]{0,3}',
                'validationMessage' => 'The Max Items property can contain only Latin symbols'
            ]
        ];
    }

    public function onRequestDetails()
    {

    }

    public function onRun()
    {
        // This code will be executed when the page or layout is
        // loaded and the component is attached to it.

        $this->addJs('/plugins/mightycode/autoscout24adapter/assets/js/plugin.js');

        $this->cars = $this->page['cars'] = $this->listCars();


        $this->page['var'] = 'value'; // Inject some variable to the page
    }

    private
    function listCars()
    {
        //TODO: Pagination
        return CarInfo::all();

    }


}