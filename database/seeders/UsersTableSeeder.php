<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // adicionar usuarios de teste
        for ($i = 1; $i <= 3; $i++) {
            User::create([
                'first_name' => 'User',
                'last_name' => $i,
                'email' => "user$i@gmail.com",
                'password' => bcrypt('Aabc1234'),
                'email_verified_at' => Carbon::now(),
                'active' => true,
            ]);
        }
    }
}
