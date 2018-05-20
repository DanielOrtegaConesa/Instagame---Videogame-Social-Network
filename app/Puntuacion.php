<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Puntuacion extends Model
{
    protected $primaryKey = "cod";
    public $incrementing = true;

    protected $table = "puntuaciones";
    protected $fillable = ["cod", "codJuego", "puntuacion", "nick"];
    public $timestamps = false;
}
