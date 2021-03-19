<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_image extends Model
{
    protected $primaryKey = "user_image_id";
    protected $table = "user_images";
    public $timestamps = false;
}
