<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genero extends Model
{
    protected $primaryKey = "cod";
    public $incrementing = true;
    protected $keyType = "int";

    protected $table = "generos";
    protected $fillable = ["numero","cod","nombre"];
    public $timestamps = false;

    public function juegos(){
        return $this->belongsToMany('App\Juego',"juegosGeneros","codGenero","codJuego");
    }
}
