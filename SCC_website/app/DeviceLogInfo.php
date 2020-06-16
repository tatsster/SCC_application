<?php


namespace App;

use Illuminate\Database\Eloquent\Model;

class DeviceLogInfo extends Model{

    protected $table = 'device_log';
    protected $primaryKey = 'device_order';
    public $incrementing = false;
    public $timestamps = false;

}
