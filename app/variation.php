<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class variation extends Model
{
    protected $primaryKey = "variation_id";
    protected $table = "variations";
    public $timestamps = false;
}
