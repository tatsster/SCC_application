<?php


namespace App;

use Illuminate\Database\Eloquent\Model;

class SettingsInfo extends Model{

    protected $table = 'settings';
    protected $primaryKey = 'settings_id';
    public $incrementing = false;
    public $timestamps = false;

}
