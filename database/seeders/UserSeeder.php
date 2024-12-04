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
     */
    public function run(): void
    {
        // if(env('APP_ENV') == 'production'){
            $admin = User::create([
                'name' => 'Administrador',
                'email' => 'admin@sia.com',
                'password' => bcrypt('Admin.24.sia'),
                'email_verified_at' => now(),
            ]);
            $admin->assignRole('Admin');
        // }else{
        //     $admin = User::create([
        //         'name' => 'Administrador',
        //         'email' => 'admin@demo.com',
        //         'password' => bcrypt('123456'),
        //         'email_verified_at' => now(),
        //     ]);
        //     $admin->assignRole('Admin');
        //     $user2 = User::create([
        //         'name' => 'Secre',
        //         'email' => 'secretario@demo.com',
        //         'password' => bcrypt('123456'),
        //         'email_verified_at' => now(),
        //     ]);
        //     $user2->assignRole('Secretario');
        // }
    }
}
