<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableCreditoCliente extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credito_cliente', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_cliente')->constantained('cliente')->cascadeOnDelete();
            $table->timestamp('data')->useCurrent();
            $table->decimal('valor', $precision = 15, $scale = 2);
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
        Schema::dropIfExists('credito_cliente');
        $table->dropForeign(['id_cliente']);
        $table->dropColumn('id_cliente');
    }
}
