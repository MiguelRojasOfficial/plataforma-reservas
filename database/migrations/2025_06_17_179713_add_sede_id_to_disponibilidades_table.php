<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('disponibilidades', function (Blueprint $table) {
        $table->unsignedBigInteger('sede_id')->nullable();
        $table->foreign('sede_id')->references('id')->on('sedes')->onDelete('cascade');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('disponibilidades', function (Blueprint $table) {
            //
        });
    }
};
