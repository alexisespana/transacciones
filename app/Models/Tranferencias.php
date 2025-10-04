<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tranferencias extends Model
{
    protected $table = 'contactos';
    public $primaryKey = "id";
    public $timestamps = false;
     protected $fillable = ['id_usuario','id_contacto'];
}
