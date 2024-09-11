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
        Schema::table('returnlogs', function (Blueprint $table) {
            $table->id(); // Menambahkan kolom ID sebagai auto-increment primary key
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('returnlogs', function (Blueprint $table) {
            $table->dropColumn('id');
        });
    }
};
