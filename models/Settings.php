<?php namespace MightyCode\Autoscout24Adapter\Models;

use Model;

/**
 * Settings Model
 */
class Settings extends Model
{

    /**
     * @var string The database table used by the model.
     */
    public $table = 'mightycode_autoscout24adapter_settings';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [];
    public $belongsTo = [];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

}