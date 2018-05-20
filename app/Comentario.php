<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    protected $primaryKey = "cod";
    public $incrementing = true;
    protected $keyType = "int";

    protected $table = "comentarios";
    protected $fillable = ["cod","nick","codJuego","comentario","reportes"];
    public $timestamps = false;

}
