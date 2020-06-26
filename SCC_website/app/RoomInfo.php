<?php


namespace App;

use Illuminate\Database\Eloquent\Model;

class RoomInfo extends Model{

    protected $table = 'room';
    protected $primaryKey = 'room_order';
    public $incrementing = false;
    public $timestamps = false;

}
