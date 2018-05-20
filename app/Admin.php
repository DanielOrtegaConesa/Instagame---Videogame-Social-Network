<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $primaryKey = "nick";
    public $incrementing = false;
    protected $keyType = "string";

    protected $table = "admins";
    protected $fillable = ["nick", "password"];
    public $timestamps = false;
}
