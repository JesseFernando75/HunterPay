<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableCreditoEmpresa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credito_empresa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_empresa')->constantained('empresa_parceira')->cascadeOnDelete();
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
        Schema::dropIfExists('credito_empresa');
        $table->dropForeign(['id_empresa']);
        $table->dropColumn('id_empresa');
    }
}
