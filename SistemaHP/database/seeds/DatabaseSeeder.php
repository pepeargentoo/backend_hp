<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
             'nombre' => 'Encargada',
             'apellido'=>'test',
             'usuario'=>'encargada',
             'dni'=>'12345',
             'telefono'=>'1234',
             'email' => 'encargada@encargada.com',
             'password'=>bcrypt('encargada'),
             'rol'=>'encargada'
         ]);
    }
}
