<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('disponibilidades', 'reservada')) {
            Schema::table('disponibilidades', function (Blueprint $table) {
                $table->boolean('reservada')->default(false);
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('disponibilidades', 'reservada')) {
            Schema::table('disponibilidades', function (Blueprint $table) {
                $table->dropColumn('reservada');
            });
        }
    }
};

