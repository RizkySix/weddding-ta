<?php

use App\Models\Decoration;
use App\Models\Package;
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
        Schema::create('package_decoration', function (Blueprint $table) {
            $table->foreignIdFor(Package::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Decoration::class);
            $table->timestamp('added_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('package_decoration');
    }
};
