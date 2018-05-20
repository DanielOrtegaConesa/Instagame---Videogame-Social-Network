<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportesUsuarios extends Model
{
    protected $primaryKey = "cod";
    public $incrementing = true;

    protected $table = "reportesUsuarios";
    protected $fillable = ["cod", "reportador", "reportado"];
    public $timestamps = false;

}
