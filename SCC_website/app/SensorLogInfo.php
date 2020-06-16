<?php


namespace App;

use Illuminate\Database\Eloquent\Model;

class SensorLogInfo extends Model{

    protected $table = 'sensor_log';
    protected $primaryKey = 'sensor_order';
    public $incrementing = false;
    public $timestamps = false;

}
