<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sub_category extends Model
{
    protected $primaryKey = "sub_id";
    protected $table = "sub_categories";
    public $timestamps = false;
}
