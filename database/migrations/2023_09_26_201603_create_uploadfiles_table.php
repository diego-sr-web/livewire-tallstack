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
    Schema::create('uploadfiles', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id');
        $table->unsignedBigInteger('company_id');
        $table->string('thumb_file');
        $table->string('title');
        $table->string('file');
        $table->boolean('status')->default(false);
        $table->timestamps();
        
        $table->foreign('user_id')->references('id')->on('users');
        $table->foreign('company_id')->references('id')->on('companies');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uploadfiles');
    }
};
