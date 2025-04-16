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
				'name'        => 'أحمد حسن',
				'phone_email' => 'ahmed@example.com',
				'content'     => 'هذه شكوى بخصوص الخدمة.',
				'is_public'   => true,
				'status'      => 'accepted',
				'type'        => 'complaint',
				'user_Id'     => null,
				'car_Id'      => null,
			],
			[
				'name'        => 'سارة محمد',
				'phone_email' => 'sara@example.com',
				'content'     => 'خدمة رائعة! استمروا في العمل الجيد.',
				'is_public'   => false,
				'status'      => 'accepted',
				'type'        => 'suggestion',
				'user_Id'     => 8,
				'car_Id'      => 14,
			],
			[
				'name'        => 'علي أحمد',
				'phone_email' => 'ali@example.com',
				'content'     => 'يجب تحسين خدمة غسيل السيارات.',
				'is_public'   => true,
				'status'      => 'accepted',
				'type'        => 'complaint_user',
				'user_Id'     => 9,
				'car_Id'      => null,
			],
			[
				'name'        => 'محمد يوسف',
				'phone_email' => 'mohammed@example.com',
				'content'     => 'أحب خدمة العملاء.',
				'is_public'   => true,
				'status'      => 'rejected',
				'type'        => 'suggestion',
				'user_Id'     => 8,
				'car_Id'      => 10,
			],
			[
				'name'        => 'فاطمة علي',
				'phone_email' => 'fatima@example.com',
				'content'     => 'يرجى إصلاح مشكلة وقت التوصيل.',
				'is_public'   => false,
				'status'      => 'pending',
				'type'        => 'suggestion',
				'user_Id'     => null,
				'car_Id'      => null,
			],
			[
				'name'        => 'أحمد خالد',
				'phone_email' => 'ahmed@example.com',
				'content'     => 'يحتاج طراز السيارة إلى تحديث التصميم.',
				'is_public'   => true,
				'status'      => 'pending',
				'type'        => 'complaint_car',
				'user_Id'     => 10,
				'car_Id'      => 7,
			],
        ]);
    }
}
