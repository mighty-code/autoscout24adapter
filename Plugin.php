<?php namespace MightyCode\Autoscout24Adapter;

use Illuminate\Support\Facades\Artisan;
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
            'name' => 'mightycode.autoscout24adapter::lang.plugin.name',
            'description' => 'mightycode.autoscout24adapter::lang.plugin.description',
            'author' => 'Oliver Kaufmann <contact@mighty-code.com',
            'icon' => 'icon-car',
            'homepage' => 'http://okaufmann.ch'
        ];
    }

    public function registerComponents()
    {
        return [
            \MightyCode\Autoscout24Adapter\Components\View::class => 'autoscoutList'
        ];
    }

    public function register()
    {
        $this->registerConsoleCommand('autoscout.importads', 'MightyCode\Autoscout24Adapter\Console\ImportInfoCommand');
    }

    public function boot()
    {
        // ..
    }

    public function registerSchedule($schedule)
    {
        $schedule->command('autoscout:importads')->everyFiveMinutes();
    }

    public function registerSettings()
    {
        return [
            'config' => [
                'label' => 'mightycode.autoscout24adapter::lang.settings.label',
                'icon' => 'icon-car',
                'description' => 'mightycode.autoscout24adapter::lang.settings.description',
                'class' => \MightyCode\Autoscout24Adapter\Models\Settings::class,
                'order' => 600
            ]
        ];
    }
}
