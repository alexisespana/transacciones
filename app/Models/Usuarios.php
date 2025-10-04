<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{
    protected $table = 'usuarios';
    public $primaryKey = "id";
    public $timestamps = false;
     protected $fillable = ['nombres','email'];

     public function contactos()
    {
        return $this->hasMany(Contactos::class, 'id_usuario', 'id');
    }
     public function saldos()
    {
        return $this->hasOne(Saldos::class, 'id_usuario', 'id');
    }
}
