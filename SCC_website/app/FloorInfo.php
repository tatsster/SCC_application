<?php


namespace App;

use Illuminate\Database\Eloquent\Model;

class FloorInfo extends Model{

    protected $table = 'floor';
    protected $primaryKey = 'floor_order';
    public $incrementing = false;
    public $timestamps = false;

}
