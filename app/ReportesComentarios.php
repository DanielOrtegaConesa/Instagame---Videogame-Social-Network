<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportesComentarios extends Model
{
    protected $primaryKey = "cod";
    public $incrementing = true;

    protected $table = "reportesComentarios";
    protected $fillable = ["cod", "reportador", "codComentario"];
    public $timestamps = false;

    public function comentario()
    {
        return $this->belongsTo('App\Comentario',"codComentario","cod");
    }
}
