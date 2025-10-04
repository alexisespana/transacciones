<?php

namespace App\Models\Transacciones;

use Illuminate\Database\Eloquent\Model;

class transacciones extends Model
{
    protected $table = 'transacciones';
    public $primaryKey = "id";
    public $timestamps = false;
}
