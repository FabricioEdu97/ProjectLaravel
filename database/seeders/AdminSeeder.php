<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'name' => 'fab',
            'email' => 'fab@gmail.com', // Altere para o email desejado
            'password' => Hash::make('123'), // Altere para a senha desejada
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
