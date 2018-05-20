<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class estadosJuegos extends Model
{
    protected $primaryKey = "cod"; // no es correcto, pero de momento eloquent no admite claves compuestas por lo que he tenido que hacerlo asi
    public $incrementing = true;

    protected $table = "estadosJuegos";
    protected $fillable = ["cod","nick", "codJuego", "estado"];
    public $timestamps = false;

    public function estadoJuego(){

    }

}
