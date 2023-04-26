<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table    = 'products';
    protected $fillable = ['title', 'price', 'description', 'main_image1', 'main_image2', 'slide_images1', 'slide_images2', 'quantity'];
    public $timestamps  = false;


    public static function getAllProducts(){

        return self::query()->select("products.*")->get();
    }




}
