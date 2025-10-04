<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Saldos extends Model
{
    protected $table = 'saldos';
    public $primaryKey = "id";
    public $timestamps = false;
     protected $fillable = ['id_usuario','saldo'];
}
