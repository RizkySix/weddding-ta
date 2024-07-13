<?php

use App\Models\PackageBooking;
use App\Models\User;
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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_id');
            $table->string('trx_id')->nullable();
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(PackageBooking::class);
            $table->string('buyer_name' , 100);
            $table->string('buyer_email');
            $table->string('buyer_phone');
            $table->string('buyer_address');
            $table->tinyInteger('discount' , false, true);
            $table->decimal('amount' , 10 , 2 ,true);
            $table->decimal('total' , 10 , 2 ,true);
            $table->string('payment_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
