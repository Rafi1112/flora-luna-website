<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Game Master',
            'username' => 'masterflora',
            'balance' => 999999,
            'email' => 'master@floraluna.com',
            'email_verified_at' => now(),
            'password' => bcrypt('123123123'),
        ]);
        $user->assignRole(1);
    }
}
