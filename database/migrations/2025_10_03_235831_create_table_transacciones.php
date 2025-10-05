<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transacciones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_emisor');
            $table->unsignedBigInteger('id_receptor');
            $table->string('monto');
            $table->date('fecha_transaccion')->defaultValue(Carbon::now());
            $table->string('estado');
            $table->foreign('id_emisor')->references('id')->on('usuarios');
            $table->foreign('id_receptor')->references('id')->on('usuarios');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transacciones');
    }
};
