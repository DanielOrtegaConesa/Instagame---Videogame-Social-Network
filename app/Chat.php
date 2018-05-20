<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $primaryKey = "cod";
    public $incrementing = true;
    protected $keyType = "int";

    protected $table = "chat";
    protected $fillable = ["cod","de","para","fecha","texto","leido"];
    public $timestamps = false;
}
