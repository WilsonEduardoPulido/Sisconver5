<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devoluciones', function (Blueprint $table) {
            $table->comment('');
            $table->bigIncrements('id');
            $table->date('Fecha_devolucion');
            $table->unsignedBigInteger('prestamos_id')->index('devolucions_prestamos_id_foreign');
            $table->unsignedBigInteger('libros_id')->index('devolucions_libros_id_foreign');
            $table->unsignedBigInteger('elementos_id')->index('devolucions_elementos_id_foreign');
            $table->unsignedBigInteger('usuario_id')->index('devolucions_usuario_id_foreign');
            $table->unsignedBigInteger('curso_id')->index('devolucions_curso_id_foreign');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('devoluciones');
    }
};
