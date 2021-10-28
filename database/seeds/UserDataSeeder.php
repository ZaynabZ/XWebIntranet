<?php

use Illuminate\Database\Seeder;
use App\User;

class UserDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'last_name' => 'Chouiekh',
            'first_name' => 'Houda',            
            'username' => 'superadmin',
            'gender' => 'F',
            'email' => 'hchouiekh@myopla.com',
            
            'password' => Hash::make('superadminMyOpla'),
            'role' => 2,

        ]);
    }
}
