<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComplaintSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('complaints_suggestions')->insert([
            [
                'name'        => 'John Doe',
                'phone_email' => 'john@example.com',
                'content'     => 'This is a complaint about service.',
                'is_public'   => true,
                'status'      => 'accepted',
                'type'        => 'complaint',
                'user_Id'     => null,
                'car_Id'      => null,
            ],
            [
                'name'        => 'Jane Smith',
                'phone_email' => 'jane@example.com',
                'content'     => 'Great service! Keep it up.',
                'is_public'   => false,
                'status'      => 'accepted',
                'type'        => 'suggestion',
                'user_Id'     => 8,
                'car_Id'      => 14,
            ],
            [
                'name'        => 'Ali Ahmed',
                'phone_email' => 'ali@example.com',
                'content'     => 'Need improvement in car wash.',
                'is_public'   => true,
                'status'      => 'accepted',
                'type'        => 'complaint_user',
                'user_Id'     => 9,
                'car_Id'      => null,
            ],
            [
                'name'        => 'Mohammed Youssef',
                'phone_email' => 'mohammed@example.com',
                'content'     => 'I love the customer service.',
                'is_public'   => true,
                'status'      => 'rejected',
                'type'        => 'suggestion',
                'user_Id'     => 8,
                'car_Id'      => 10,
            ],
            [
                'name'        => 'Fatima Ali',
                'phone_email' => 'fatima@example.com',
                'content'     => 'Please fix the delivery time issue.',
                'is_public'   => false,
                'status'      => 'pending',
                'type'        => 'suggestion',
                'user_Id'     => null,
                'car_Id'      => null,
            ],
            [
                'name'        => 'Ahmed Khaled',
                'phone_email' => 'ahmed@example.com',
                'content'     => 'The car model needs a design update.',
                'is_public'   => true,
                'status'      => 'pending',
                'type'        => 'complaint_car',
                'user_Id'     => 10,
                'car_Id'      => 7,
            ],
        ]);
    }
}
