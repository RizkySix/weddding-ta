<?php

namespace Database\Seeders;

use App\Http\Controllers\Auth\UserConstantRole;
use App\Models\Order;
use App\Models\OrderReference;
use App\Models\Package;
use App\Models\PackageBooking;
use App\Models\User;
use App\Trait\HelperTrait;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class OrderSeeder extends Seeder
{
    use HelperTrait;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            //strtoupper(Str::random(10) . '-LKSD')

            $user = User::where('role' , UserConstantRole::CUSTOMER)->first();

            for($i = 0; $i < 20; $i++) {
                $randPackage = Package::with(['price'])->inRandomOrder()->first();
                $start = now()->addDays(rand(1,3));
                $end = now()->addDays(rand(4,6));
                $diffInDays = $start->diffInDays($end);
                
                $booking = PackageBooking::create([
                    'uuid' => $this->setUuid(),
                    'package_id' => $randPackage->id,
                    'start_date' => $start,
                    'end_date' => $end,
                    'started_confirm_at' => $start, 
                    'ended_confirm_at' => $end, 
                ]);

                //amount
                $amount = $randPackage->price->price * $diffInDays;
                $discountPercentage = $randPackage->price->discount;
                $discountDecimal = $discountPercentage / 100;
                $discountAmount = $amount * $discountDecimal;
                $total = $amount - $discountAmount;

                $minPercenAm = $amount * (60/100);
                $minPercenAm = $amount + $minPercenAm;
                $minPercenTot = $total * (60/100);
                $minPercenTot = $total + $minPercenTot;
                $order = Order::create([
                    'order_id' => strtoupper(Str::random(10) . '-LKSD'),
                    'trx_id' => rand(10000000,9999999),
                    'user_id' => $user->id,
                    'package_booking_id' => $booking->id,
                    'buyer_name' => $user->name,
                    'buyer_phone' => fake()->phoneNumber(),
                    'buyer_email' => $user->email,
                    'buyer_address' => fake()->address(),
                    'discount' => $randPackage->price->discount,
                    'amount' => $amount,
                    'total' =>  $total,
                    'payment_url' => fake()->url(),
                    'expired_at' => $i % 2 == 0 ? now()->addDay(1) : now()->subDays(20)->addDay(1),
                    'product_name' => $randPackage->name,
                    'created_at' => $i % 2 == 0 ? now() : now()->subDays(20),
                    'updated_at' => $i % 2 == 0 ? now() : now()->subDays(20),


                ]);


                OrderReference::create([
                    'uuid' => $this->setUuid(),
                    'order_id' => $order->id,
                    'status' => 'berhasil',
                    'via' => 'bca',
                    'channel' => 'bank',
                    'va' => strtoupper(Str::random(10) . '-BCA'),
                    'invoice' => fake()->url(),
                    'created_at' => $i % 2 == 0 ? now()->addDay(rand(1,4)) : now()->subDays(20),
                    'updated_at' => $i % 2 == 0 ? now()->addDay(rand(1,4)) : now()->subDays(20),
                ]);
            }
    }
}
