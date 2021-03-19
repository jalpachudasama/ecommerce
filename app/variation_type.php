<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class variation_type extends Model
{
    protected $primaryKey = "variation_type_id";
    protected $table = "variation_types";
    public $timestamps = false;
}
