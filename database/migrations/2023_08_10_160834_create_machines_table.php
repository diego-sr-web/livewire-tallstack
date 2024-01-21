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
        Schema::create('machines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->index();
            $table->foreign('company_id')->references('id')->on('companies');
            $table->string('name', 50);
            $table->string('slug', 50);
            $table->string('description')->nullable();
            $table->text('file')->nullable();
            $table->boolean('status')->default(false); 
            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('machines');
    }
};
