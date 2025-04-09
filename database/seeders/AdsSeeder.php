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
                'FullName'   => 'Dell Inspiron 15',
                'Image'      => 'ads/Ads_1743940388_67f26b240dfc5.jpg',
                'hit'        => 0,
                'ad_Url'     => 'https://laptopmedia.com/laptop-specs/dell-inspiron-15-3567-280/',
                'location'   => 'Home Page',
                'start_date' => Carbon::now(),
                'End_date'   => Carbon::now()->addDay(),
                'status'     => 'pending',
            ],
            [
                'FullName'   => 'HP Pavilion 14',
                'Image'      => 'ads/Ads_1743940413_67f26b3d1175f.jpg',
                'hit'        => 0,
                'ad_Url'     => 'https://www.bhphotovideo.com/c/product/1410615-REG/hp_3we91ua_aba_pv14_ba110nr_i5_8250u_8gb_256ssd.html',
                'location'   => 'Sidebar',
                'start_date' => Carbon::now(),
                'End_date'   => Carbon::now()->addDay(),
                'status'     => 'pending',
            ],
            [
                'FullName'   => 'Samsung Galaxy S24',
                'Image'      => 'ads/Ads_1743940451_67f26b6320dae.jpg',
                'hit'        => 0,
                'ad_Url'     => 'https://www.techloy.com/the-samsung-galaxy-s24-series-specs-features-and-pricing/',
                'location'   => 'Footer',
                'start_date' => Carbon::now(),
                'End_date'   => Carbon::now()->addMonth(),
                'status'     => 'published',
            ],
            [
                'FullName'   => 'Apple MacBook Offer',
                'Image'      => 'ads/Ads_1743940472_67f26b78b11cc.png',
                'hit'        => 0,
                'ad_Url'     => 'https://www.techradar.com/news/macbook-pro-apple-sale-amazon-deals',
                'location'   => 'Header',
                'start_date' => Carbon::now(),
                'End_date'   => Carbon::now()->addWeek(),
                'status'     => 'published',
            ],
            [
                'FullName'   => 'Xiaomi 13 Pro Specifications and Appearance',
                'Image'      => 'ads/Ads_1743940490_67f26b8a43c7b.jpg',
                'hit'        => 0,
                'ad_Url'     => 'https://telegra.ph/Xiaomi-13-Pro-Specifications-and-Appearance-02-14',
                'location'   => 'Home Page',
                'start_date' => Carbon::now(),
                'End_date'   => Carbon::now()->addWeek(),
                'status'     => 'pending',
            ],
        ]);
    }
}
