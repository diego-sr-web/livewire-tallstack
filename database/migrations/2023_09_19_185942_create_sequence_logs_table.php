<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sequence_logs', function (Blueprint $table) {
            $table->id();
            $table->morphs('rel');
            $table->foreignId('sequence_id')->index();
            $table->integer('order')->nullable();
            $table->foreign('sequence_id')->references('id')->on('sequences');
            $table->enum('action', ['C', 'U', 'D', 'S', 'P'])->default('C');
            $table->string('log')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sequence_logs');
    }
};
