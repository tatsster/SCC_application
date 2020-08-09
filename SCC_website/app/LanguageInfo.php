<?php


namespace App;

use Illuminate\Database\Eloquent\Model;

class LanguageInfo extends Model{

    protected $table = 'language';
    protected $primaryKey = 'language_id';
    public $incrementing = false;
    public $timestamps = false;

}
