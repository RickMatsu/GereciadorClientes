<?php

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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('email')->unique();
            $table->string('cpf', 11)->nullable();
            $table->string('cnpj', 14)->nullable();
            $table->date('data_nascimento')->nullable();
            $table->date('data_recebimento')->nullable();
            $table->string('nome_empresa')->nullable();
            $table->unsignedBigInteger('operadora')->nullable();
            $table->unsignedBigInteger('status')->nullable();
            $table->decimal('valor', 10, 2)->nullable();
            $table->integer('numero_proposta')->nullable();
            $table->text('observacao')->nullable();
            $table->timestamps();
            $table->foreign('operadora_id')->references('id')->on('operadoras')->onDelete('set null');
            $table->foreign('status_id')->references('id')->on('status_cliente')->onDelete('set null');
            $table->index('cpf');
            $table->index('cnpj');
            $table->integer('numero_vidas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
