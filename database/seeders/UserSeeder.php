<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'John',
            'email' => 'john@example.com',
            'password' => Hash::make('secret')
        ]);
        User::create([
            'name' => 'Mary',
            'email' => 'mary@example.com',
            'password' => Hash::make('secret')
        ]);
    }
}
