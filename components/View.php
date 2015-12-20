<?php namespace MightyCode\Autoscout24Adapter\Components;

use Cms\Classes\ComponentBase;
use Illuminate\Support\Facades\Lang;
use MightyCode\Autoscout24Adapter\Models\CarInfo;

class View extends ComponentBase
{
    /**
     * @var array List of Cars will shown in the current view
     */
    private $cars;

    public function componentDetails()
    {
        return [
            'name' => Lang::get("mightycode.autoscout24adapter::lang.components.listview.name"),
            'description' => Lang::get("mightycode.autoscout24adapter::lang.components.listview.description")
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

    public function onRun()
    {
        // This code will be executed when the page or layout is
        // loaded and the component is attached to it.

        $this->addJs('/plugins/mightycode/autoscout24adapter/assets/js/plugin.js');

        $this->cars = $this->page['cars'] = $this->listCars();

        $this->page['detailText'] = Lang::get('mightycode.autoscout24adapter::lang.components.listview.texts.details');
        $this->page['confirmText'] = Lang::get('mightycode.autoscout24adapter::lang.components.listview.texts.confirm');
        $this->page['mileageText'] = Lang::get('mightycode.autoscout24adapter::lang.components.listview.texts.mileage');
        $this->page['yearText'] = Lang::get('mightycode.autoscout24adapter::lang.components.listview.texts.year');
        $this->page['priceText'] = Lang::get('mightycode.autoscout24adapter::lang.components.listview.texts.price');

        $this->page['var'] = 'value'; // Inject some variable to the page
    }

    private function listCars()
    {
        //TODO: Pagination
        return CarInfo::all();
    }
}