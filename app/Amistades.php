<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Amistades extends Model
{
    protected $primaryKey = "cod";
    public $incrementing = true;

    protected $table = "amistades";
    protected $fillable = ["cod","nick1", "nick2"];
    public $timestamps = false;
}
