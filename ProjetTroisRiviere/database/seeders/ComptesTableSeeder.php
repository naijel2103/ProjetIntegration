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
        DB::table('Comptes')->insert([
              [
                'id' => 1,
                'nom' => 'Michaud',
                'email' => 'test@gmail.com',
                'password' => Hash::make('test'),
                'role' => 'Admin',
                'code' => 'aucun',
                'admin' => true,
                'verifier' => true,
              ],
              [
                'id' =>2,
                'nom' => 'Arthur',
                'email' => 'arthur@gmail.com',
                'password' => Hash::make('arthur'),
                'role' => 'Fournisseur',
                'code' => 'aucun',
                'admin' => false,
                'verifier' => true,
              ],
              [
                'id' =>3,
                'nom' => 'Julien',
                'email' => 'julien@gmail.com',
                'password' => Hash::make('julien'),
                'role' => 'Responsable',
                'code' => 'aucun',
                'admin' => true,
                'verifier' => true,
              ],
            
            ]);
    }
}


