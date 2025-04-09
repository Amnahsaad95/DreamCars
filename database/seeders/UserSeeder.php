<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name'          => 'Admin',
                'email'         => 'admin@dreamcar.com',
                'password'      => Hash::make('password123'),
                'phone'         => '1234567890',
                'city'          => 'Damascus',
                'country'       => 'Syria',
                'profile_Image' => 'profile/default-profile.png',
                'Role'          => 1, // admin role
            ],
            [
                'name'          => 'Jane Smith',
                'email'         => 'janesmith@example.com',
                'password'      => Hash::make('password123'),
                'phone'         => '0987654321',
                'city'          => 'Aleppo',
                'country'       => 'Syria',
                'profile_Image' => 'profile/default-profile.png',
                'Role'          => 2, // user role
            ],
            [
                'name'          => 'Mohammad Al-Fayed',
                'email'         => 'mohammad@example.com',
                'password'      => Hash::make('password123'),
                'phone'         => '1230984567',
                'city'          => 'Homs',
                'country'       => 'Syria',
                'profile_Image' => 'profile/default-profile.png',
                'Role'          => 2, // user role
            ],
            [
                'name'          => 'Ali Hassan',
                'email'         => 'alihassan@example.com',
                'password'      => Hash::make('password123'),
                'phone'         => '4567891230',
                'city'          => 'Latakia',
                'country'       => 'Syria',
                'profile_Image' => 'profile/default-profile.png',
                'Role'          => 2, // user role
            ],
            [
                'name'          => 'Fatima Zohra',
                'email'         => 'fatimazohra@example.com',
                'password'      => Hash::make('password123'),
                'phone'         => '3216549870',
                'city'          => 'Tartus',
                'country'       => 'Syria',
                'profile_Image' => 'profile/default-profile.png',
                'Role'          => 2, // user role
            ],
            [
                'name'          => 'Sami Kassem',
                'email'         => 'samikassem@example.com',
                'password'      => Hash::make('password123'),
                'phone'         => '8527419630',
                'city'          => 'Damascus',
                'country'       => 'Syria',
                'profile_Image' => 'profile/default-profile.png',
                'Role'          => 2, // user role
            ],
            [
                'name'          => 'Rania Youssef',
                'email'         => 'raniayoussef@example.com',
                'password'      => Hash::make('password123'),
                'phone'         => '7896541230',
                'city'          => 'Aleppo',
                'country'       => 'Syria',
                'profile_Image' => 'profile/default-profile.png',
                'Role'          => 2, // user role
            ],
            [
                'name'          => 'Khaled Nasser',
                'email'         => 'khalednasser@example.com',
                'password'      => Hash::make('password123'),
                'phone'         => '6543217890',
                'city'          => 'Homs',
                'country'       => 'Syria',
                'profile_Image' => 'profile/default-profile.png',
                'Role'          => 2, // user role
            ],
            [
                'name'          => 'Zeinab Ali',
                'email'         => 'zeinabali@example.com',
                'password'      => Hash::make('password123'),
                'phone'         => '3219876540',
                'city'          => 'Latakia',
                'country'       => 'Syria',
                'profile_Image' => 'profile/default-profile.png',
                'Role'          => 2, // user role
            ],
            [
                'name'          => 'Rami Hassan',
                'email'         => 'ramihassan@example.com',
                'password'      => Hash::make('password123'),
                'phone'         => '1597534862',
                'city'          => 'Tartus',
                'country'       => 'Syria',
                'profile_Image' => 'profile/default-profile.png',
                'Role'          => 2, // user role
            ]
        ];

        DB::table('users')->insert($users);
    }
}
