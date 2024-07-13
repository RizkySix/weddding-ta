<?php

namespace Database\Seeders;

use App\Http\Controllers\Auth\UserConstantRole;
use App\Models\User;
use App\Trait\HelperTrait;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    use HelperTrait;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [UserConstantRole::ADMIN, UserConstantRole::EMPLOYEE, UserConstantRole::CUSTOMER];

        for($i = 0; $i< 3; $i++) {
            User::create([
                'uuid' => $this->setUuid(),
                'name' => fake()->name(),
                'email' => $i == 0 ? 'admin@gmail.com' : fake()->email(),
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role' => $roles[$i]
            ]);
        }
    }
}
