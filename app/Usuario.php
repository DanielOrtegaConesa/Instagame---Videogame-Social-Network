<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Perfil;
use App\estadosJuegos;

class Usuario extends Model
{

    protected $primaryKey = "nick";
    public $incrementing = false;
    protected $keyType = "string";

    protected $table = "usuarios";
    protected $fillable = ["nick", "password", "validado","baneado", "clave"];
    public $timestamps = false;

    public function perfil()
    {
        return $this->belongsTo("App\Perfil", 'nick', "nick");
    }

    public function juegos()
    {
        return $this->belongsToMany('App\Juego', "estadosJuegos", "nick", "codJuego")->orderBy("nombre");
    }
    public function cjuegos($nick){
        return estadosJuegos::where("nick",$nick)->where("estado","jugando")->count();
    }

    public static function estadoJuego($usuario, $juego)
    {
        $respuesta = estadosJuegos::where("nick", $usuario)->where("codJuego", $juego)->first();
        if ($respuesta != NULL) {
            return $respuesta->estado;
        }
        return "";
    }
    public function puntuacionJuego($juego){
        $puntuacion = Puntuacion::where("codJuego",$juego)->where("nick",session("usuario")->nick)->first();
        if($puntuacion!= null){
            return $puntuacion->puntuacion;
        }else{
            return "Sin Puntuar";
        }
    }
}
