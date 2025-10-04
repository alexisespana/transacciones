<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contactos extends Model
{
    protected $table = 'contactos';
    public $primaryKey = "id";
    public $timestamps = false;
    protected $fillable = ['id_usuario', 'id_contacto'];


    public function usuarios()
    {
        return $this->hasOne(Usuarios::class, 'id', 'id_contacto');
    }
}
