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
        Schema::create('meis', function (Blueprint $table) {
            $table->id();
            $table->string('mei_cnpj', 20)->unique();
            $table->string('mei_nome', 100)->nullable();
            $table->string('mei_email', 100)->nullable();
            $table->string('mei_telefone', 15)->nullable();
            $table->integer('mei_entregue')->nullable();
            $table->string('mei_cep', 15)->nullable();
            $table->timestamp('mei_lastupdate')->nullable()->useCurrent();
            $table->string('mei_situacao', 45)->nullable();
            $table->integer('mei_status')->nullable();
            $table->integer('mei_ano')->nullable();
            $table->string('mei_endereco', 100)->nullable();
            $table->string('mei_numero', 45)->nullable();
            $table->string('mei_complemento', 45)->nullable();
            $table->string('mei_bairro', 45)->nullable();
            $table->string('mei_cidade', 45)->nullable();
            $table->string('mei_uf', 2)->nullable();
            $table->string('mei_cnae', 15)->nullable();
            $table->string('mei_cnae_desc', 255)->nullable();
    
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meis');
    }
};
