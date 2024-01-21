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
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('step_id')->index();
            $table->foreign('step_id')->references('id')->on('steps');
            $table->foreignId('company_id')->index();
            $table->foreign('company_id')->references('id')->on('companies');
            $table->string('name', 60);
            $table->string('email', 60);
            $table->enum('internacionalization', ['BR', 'USA', 'EU'])->default('BR');
            $table->boolean('active')->default(1);
            $table->tinyInteger('status')->default(1);
            $table->boolean('annual_declaration')->default(0);
            $table->tinyInteger('option')->default(1);
            $table->boolean('exclusive')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
