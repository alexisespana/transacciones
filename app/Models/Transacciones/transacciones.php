<?php

namespace App\Models\Transacciones;

use App\Models\Usuarios;
use Illuminate\Database\Eloquent\Model;

class transacciones extends Model
{
  protected $table = 'transacciones';
  public $primaryKey = "id";
  public $timestamps = false;

  protected $fillable = ['id_emisor', 'id_receptor', 'monto', 'fecha_transaccion', 'estado'];

  public function emisor()
  {
    return $this->hasOne(Usuarios::class, 'id', 'id_emisor');
  }
  public function receptor()
  {
    return $this->hasOne(Usuarios::class, 'id', 'id_receptor');
  }
}
