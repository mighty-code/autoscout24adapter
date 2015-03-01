<?php namespace MightyCode\Autoscout24Adapter\Models;

use Model;

/**
 * Settings Model
 */
class Settings extends Model
{

    public $implement = ['System.Behaviors.SettingsModel'];

    // A unique code
    public $settingsCode = 'mightycode_autoscout24adapter_settings';

    // Reference to field configuration
    public $settingsFields = 'fields.yaml';

}