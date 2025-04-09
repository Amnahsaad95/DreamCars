<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('ads')->insert([
            [
                'FullName'   => 'Adidas Summer Sale',
                'Image'      => 'ads/Ads_1743940388_67f26b240dfc5.jpg',
                'hit'        => 0,
                'ad_Url'     => 'http://127.0.0.1:8000/CarDetail/22',
                'location'   => 'Home Page',
                'start_date' => Carbon::now(),
                'End_date'   => Carbon::now()->addDay(),
                'status'     => 'pending',
            ],
            [
                'FullName'   => 'Nike New Collection',
                'Image'      => 'ads/Ads_1743940413_67f26b3d1175f.jpg',
                'hit'        => 0,
                'ad_Url'     => 'http://127.0.0.1:8000/CarDetail/21',
                'location'   => 'Sidebar',
                'start_date' => Carbon::now(),
                'End_date'   => Carbon::now()->addDay(),
                'status'     => 'pending',
            ],
            [
                'FullName'   => 'Samsung Galaxy S24',
                'Image'      => 'ads/Ads_1743940451_67f26b6320dae.jpg',
                'hit'        => 0,
                'ad_Url'     => 'http://127.0.0.1:8000/CarDetail/23',
                'location'   => 'Footer',
                'start_date' => Carbon::now(),
                'End_date'   => Carbon::now()->addMonth(),
                'status'     => 'published',
            ],
            [
                'FullName'   => 'Apple MacBook Offer',
                'Image'      => 'ads/Ads_1743940472_67f26b78b11cc.jpg',
                'hit'        => 0,
                'ad_Url'     => 'http://127.0.0.1:8000/CarDetail/25',
                'location'   => 'Header',
                'start_date' => Carbon::now(),
                'End_date'   => Carbon::now()->addWeek(),
                'status'     => 'published',
            ],
            [
                'FullName'   => 'Amazon Deals',
                'Image'      => 'Ads_1743940490_67f26b8a43c7b',
                'hit'        => 0,
                'ad_Url'     => 'http://127.0.0.1:8000/CarDetail/20',
                'location'   => 'Home Page',
                'start_date' => Carbon::now(),
                'End_date'   => Carbon::now()->addWeek(),
                'status'     => 'pending',
            ],
        ]);
    }
}
