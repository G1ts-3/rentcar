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
        try {
            Schema::table('vehicles', function (Blueprint $table) {
                $table->unique('plate_number');
            });
        } catch (\Illuminate\Database\QueryException $e) {
            // Unique constraint already exists from create_vehicles_table migration
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->dropUnique('plate_number');
        });
    }
};
