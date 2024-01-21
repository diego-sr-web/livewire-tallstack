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
        Schema::create('step_logs', function (Blueprint $table) {
            $table->id();
            $table->morphs('rel');
            $table->foreignId('step_id')->index();
            $table->foreign('step_id')->references('id')->on('steps');
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
        Schema::dropIfExists('step_logs');
    }
};
