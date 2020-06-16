<?php


namespace App;

use Illuminate\Database\Eloquent\Model;

class SensorInfo extends Model{

    protected $table = 'sensor';
    protected $primaryKey = 'sensor_id';
    public $incrementing = false;
    public $timestamps = false;

}
