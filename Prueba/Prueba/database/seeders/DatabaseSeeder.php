<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

      User::create([
    'name' => 'Camilo',
    'apellido'=>'Diaz',
    'tipo_documento' => 'CC',
    'numero_documento' => '1673278198',
    'password'=>Hash::make('admin123'),
    'role'=>'admin'
]);

      User::create([
    'name' => 'Andrey',
    'apellido'=>"Diaz",
    'tipo_documento' => 'CC',
    'numero_documento' => '125094839',
    'password'=>Hash::make('admin123'),
    'role'=>'admin'
]);

    }
}
