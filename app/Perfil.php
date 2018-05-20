<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Usuario;

class Perfil extends Model
{
    protected $primaryKey = "nick";
    public $incrementing = false;
    protected $keyType = "string";

    protected $table = "perfiles";
    protected $fillable = ["nick", "img", "descripcion","horario","horariofin","red"];
    public $timestamps = false;

    public function perfil(){
        return $this->belongsTo("App\Usuario", 'nick');
    }
}
