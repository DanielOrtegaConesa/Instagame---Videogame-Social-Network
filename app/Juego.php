<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Juego extends Model
{
    protected $primaryKey = "cod";
    public $incrementing = false;
    protected $keyType = "int";

    protected $table = "juegos";
    protected $fillable = ["cod", "nombre","year","descripcion","img"];
    public $timestamps = false;

    public function generos(){
        return $this->belongsToMany('App\Genero',"juegosGeneros","codJuego","codGenero");
    }

    public function usuarios(){
        return $this->belongsToMany('App\Usuario',"estadosJuegos","codJuego","nick");
    }

    public function cusuarios($codigojuego){
        return estadosJuegos::where("codJuego",$codigojuego)->where("estado","jugando")->count();
    }
    public static function estadoJuego($usuario, $juego)
    {
        $respuesta = estadosJuegos::where("nick", $usuario)->where("codJuego", $juego)->first();
        if ($respuesta != NULL) {
            return $respuesta->estado;
        }
        return "";
    }

    public function comentarios(){
        return $this->hasMany("App\Comentario","codJuego","cod");
    }

    public function puntuacion($juego){
        $puntuacion = Puntuacion::where("codJuego",$juego)->avg('puntuacion');
        if($puntuacion== null) return 0;
        return $puntuacion;
    }
}
