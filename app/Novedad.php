<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Novedad extends Model
{
    protected $primaryKey = "cod";
    public $incrementing = true;

    protected $table = "novedades";
    protected $fillable = ["cod", "nick", "texto", "fecha","tipo","asociado"];
    public $timestamps = false;
}
