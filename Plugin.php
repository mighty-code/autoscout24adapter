<?php namespace MightyCode\Autoscout24Adapter;

use System\Classes\PluginBase;

/**
 * Autoscout24Adapter Plugin Information File
 */
class Plugin extends PluginBase
{

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Autoscout24 Adapter',
            'description' => 'Get access of your autoscout24.ch ads',
            'author'      => 'Oliver Kaufmann <contact@mighty-code.com',
            'icon'        => 'icon-leaf',
            'homepage'    => 'http://mighty-code.com'
        ];
    }

    public function registerComponents()
    {
        return [
            'MightyCode\Autoscout24Adapter\Components\View' => 'autoscoutList'
        ];
    }

    public function register(){
        $this->registerConsoleCommand('autoscout.importads', 'MightyCode\Autoscout24Adapter\Console\ImportInfoCommand');
    }

    public function boot(){
        //\App::register('\Third\Party\ServiceProvider');
    }

    public function registerSchedule($schedule){
        //TODO scheduled import of ads
    }

}
