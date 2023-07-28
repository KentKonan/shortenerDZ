<?php


namespace Kent\PhpPro\DB\Models;

use Illuminate\Database\Eloquent\Model;

class Shortener extends Model
{


    protected $table = "shortener";

    protected $fillable = [
        'code',
        'url'
    ];
    public $timestamps = false;


}
