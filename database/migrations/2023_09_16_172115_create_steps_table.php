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
        Schema::create('steps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sequence_id')->index();
            $table->foreign('sequence_id')->references('id')->on('sequences');
            $table->foreignId('step_settings_id')->index();
            $table->foreign('step_settings_id')->references('id')->on('step_settings');
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('order')->nullable();
            $table->boolean('active')->default(1);
            $table->tinyInteger('status')->default(0);
            $table->integer('leads_reached')->default(0);
            $table->integer('sent')->default(0);
            $table->decimal('open')->default(0.0);
            $table->decimal('clicks')->default(0.0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('steps');
    }
};
