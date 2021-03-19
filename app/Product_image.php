<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_image extends Model
{
     protected $primaryKey = "product_image_id";
    protected $table = "product_images";
    public $timestamps = false;
}
