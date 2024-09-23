<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class ComptesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('comptes')->insert([
              [
                'id' => 1,
                'nom' => 'MichaudInc',
                'email' => 'test@gmail.com',
                'neq' => 'aucun',
                'password' => Hash::make('test'),
                'role' => 'admin',
                'code' => 'aucun',
                'admin' => true
              ]
            
            ]);
    }
}


