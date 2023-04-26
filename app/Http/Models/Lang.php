<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Lang extends Model{
    protected $table    = 'langs';
    protected $fillable = ['lang_title'];
    public $timestamps  = false;

}
