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
        Schema::table('package_bookings', function (Blueprint $table) {
            $table->dateTime('started_confirm_at')->nullable();
            $table->dateTime('ended_confirm_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('package_bookings', function (Blueprint $table) {
            $table->dateTime('started_confirm_at')->nullable();
            $table->dateTime('ended_confirm_at')->nullable();
        });
    }
};
