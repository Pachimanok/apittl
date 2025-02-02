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
        Schema::create('interest_points', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('description');
            $table->decimal('latitude', 19, 16);
            $table->decimal('longitude', 19, 16);
            $table->decimal('radius', 8, 3);
            $table->string('status_transition');
            
            // Acciones cuando se entra
            $table->boolean('accion_correo_customer_entrada')->default(false);
            $table->boolean('accion_correo_cliente_entrada')->default(false);
            $table->boolean('accion_notificacion_customer_entrada')->default(false);
            $table->boolean('accion_notificacion_cliente_entrada')->default(false);
            
            // Acciones cuando se sale
            $table->boolean('accion_correo_customer_salida')->default(false);
            $table->boolean('accion_correo_cliente_salida')->default(false);
            $table->boolean('accion_notificacion_customer_salida')->default(false);
            $table->boolean('accion_notificacion_cliente_salida')->default(false);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('interest_points');
    }
};
