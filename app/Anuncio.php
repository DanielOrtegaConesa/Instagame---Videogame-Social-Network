<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anuncio extends Model
{
    protected $primaryKey = "cod";
    public $incrementing = true;
    protected $keyType = "int";

    protected $table = "anuncios";
    protected $fillable = ["cod","img","nick","titulo","texto","precio","fecha","vendido"];
    public $timestamps = false;
}
