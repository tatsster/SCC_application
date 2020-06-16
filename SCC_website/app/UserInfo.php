<?php


namespace App;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model{

    protected $table = 'user';
    protected $primaryKey = 'user_id';
    public $incrementing = false;
    public $timestamps = false;

}
