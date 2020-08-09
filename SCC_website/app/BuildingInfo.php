<?php


namespace App;

use Illuminate\Database\Eloquent\Model;

class BuildingInfo extends Model{

    protected $table = 'building';
    protected $primaryKey = 'building_order';
    public $incrementing = false;
    public $timestamps = false;

}
