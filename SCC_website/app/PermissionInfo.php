<?php


namespace App;

use Illuminate\Database\Eloquent\Model;

class PermissionInfo extends Model{

    protected $table = 'permission';
    protected $primaryKey = 'permission_id';
    public $incrementing = false;
    public $timestamps = false;

}
