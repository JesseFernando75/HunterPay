<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableCliente extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cliente', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->foreignId('id_user')->constantained('users')->cascadeOnDelete();
            $table->double('cpf', 11)->unique();
            $table->string('telefone');
            $table->integer('num_conta');
            $table->decimal('saldo', $precision = 15, $scale = 2);
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
        Schema::dropIfExists('cliente');
        $table->dropForeign(['id_users']);
        $table->dropColumn('id_users');
    }
}
