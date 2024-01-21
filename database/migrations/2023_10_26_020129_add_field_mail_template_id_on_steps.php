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
        Schema::table('steps', function (Blueprint $table) {
            $table->unsignedBigInteger('mail_template_id')->index()->after('step_settings_id');
            $table->foreign('mail_template_id')->references('id')->on('mail_templates')->after('step_settings_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('steps', function (Blueprint $table) {
            $table->dropColumn('mail_template_id');
        });
    }
};
