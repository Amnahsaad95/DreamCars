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
				'name'          => 'مدير النظام',
				'email'         => 'admin@dreamcar.com',
				'password'      => Hash::make('password123'),
				'phone'         => '1234567890',
				'city'          => 'دمشق',
				'country'       => 'سوريا',
				'profile_Image' => 'profile/default-profile.png',
				'Role'          => 1, // admin role
			],
			[
				'name'          => 'جين سميث',
				'email'         => 'janesmith@example.com',
				'password'      => Hash::make('password123'),
				'phone'         => '0987654321',
				'city'          => 'حلب',
				'country'       => 'سوريا',
				'profile_Image' => 'profile/default-profile.png',
				'Role'          => 2, // user role
			],
			[
				'name'          => 'محمد الفايد',
				'email'         => 'mohammad@example.com',
				'password'      => Hash::make('password123'),
				'phone'         => '1230984567',
				'city'          => 'حمص',
				'country'       => 'سوريا',
				'profile_Image' => 'profile/default-profile.png',
				'Role'          => 2, // user role
			],
			[
				'name'          => 'علي حسن',
				'email'         => 'alihassan@example.com',
				'password'      => Hash::make('password123'),
				'phone'         => '4567891230',
				'city'          => 'اللاذقية',
				'country'       => 'سوريا',
				'profile_Image' => 'profile/default-profile.png',
				'Role'          => 2, // user role
			],
			[
				'name'          => 'فاطمة الزهراء',
				'email'         => 'fatimazohra@example.com',
				'password'      => Hash::make('password123'),
				'phone'         => '3216549870',
				'city'          => 'طرطوس',
				'country'       => 'سوريا',
				'profile_Image' => 'profile/default-profile.png',
				'Role'          => 2, // user role
			],
			[
				'name'          => 'سامي قاسم',
				'email'         => 'samikassem@example.com',
				'password'      => Hash::make('password123'),
				'phone'         => '8527419630',
				'city'          => 'دمشق',
				'country'       => 'سوريا',
				'profile_Image' => 'profile/default-profile.png',
				'Role'          => 2, // user role
			],
			[
				'name'          => 'رانيا يوسف',
				'email'         => 'raniayoussef@example.com',
				'password'      => Hash::make('password123'),
				'phone'         => '7896541230',
				'city'          => 'حلب',
				'country'       => 'سوريا',
				'profile_Image' => 'profile/default-profile.png',
				'Role'          => 2, // user role
			],
			[
				'name'          => 'خالد ناصر',
				'email'         => 'khalednasser@example.com',
				'password'      => Hash::make('password123'),
				'phone'         => '6543217890',
				'city'          => 'حمص',
				'country'       => 'سوريا',
				'profile_Image' => 'profile/default-profile.png',
				'Role'          => 2, // user role
			],
			[
				'name'          => 'زينب علي',
				'email'         => 'zeinabali@example.com',
				'password'      => Hash::make('password123'),
				'phone'         => '3219876540',
				'city'          => 'اللاذقية',
				'country'       => 'سوريا',
				'profile_Image' => 'profile/default-profile.png',
				'Role'          => 2, // user role
			],
			[
				'name'          => 'رامي حسن',
				'email'         => 'ramihassan@example.com',
				'password'      => Hash::make('password123'),
				'phone'         => '1597534862',
				'city'          => 'طرطوس',
				'country'       => 'سوريا',
				'profile_Image' => 'profile/default-profile.png',
				'Role'          => 2, // user role
			]
		];

        DB::table('users')->insert($users);
    }
}
