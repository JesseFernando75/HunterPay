<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableTransacao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transacao', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_cliente')->constantained('cliente')->cascadeOnDelete();
            $table->foreignId('id_empresa')->constantained('empresa_parceira')->cascadeOnDelete();
            $table->foreignId('id_status')->constantained('status_transacao')->cascadeOnDelete();
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
        Schema::dropIfExists('transacao');
        $table->dropForeign(['id_cliente']);
        $table->dropColumn('id_cliente');
        $table->dropForeign(['id_empresa']);
        $table->dropColumn('id_empresa');
        $table->dropForeign(['id_status']);
        $table->dropColumn('id_status');
    }
}
