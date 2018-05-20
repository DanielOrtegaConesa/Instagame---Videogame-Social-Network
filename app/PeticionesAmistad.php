<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PeticionesAmistad extends Model
{
    protected $primaryKey = "cod";
    public $incrementing = true;

    protected $table = "peticionesAmistad";
    protected $fillable = ["cod","nick1", "nick2"];
    public $timestamps = false;
}
