<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $primaryKey = "state_id";
    protected $table = "states";
    public $timestamps = false;
}
