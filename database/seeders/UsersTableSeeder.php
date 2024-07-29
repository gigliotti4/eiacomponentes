<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Generate dummy users
     
            DB::table('users')->insert([
                'name' => 'Pablo',
                'username' => 'pablo',
                'role' => 'Administrador',
                'email' => 'pablo'. '@gmail.com',
                'password' => Hash::make('pablopablo'), // Default password for all users
                'remember_token' => Str::random(10),
            ]);
        
    }
}
