<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $setting= [
					'site_name'=>'Dream Cars',
					'sitemail' => 'contact@dreamcars.com',
					'site_icon' => 'Icon_1744269375_67f7703f50533.png',
					'facebook_url' => 'https://facebook.com/',
					'instagram_url' => 'https://instagram.com/',
					'whatsapp_number' => '1234567890', 
					'intro_title_1' => 'Search Smart... Buy Comfortably !',
					'intro_text_1' => 'Clear details, real photos, direct contact with sellers — everything made simple for you .',
					'intro_title_2' => 'Still Searching? The Best Cars Are Right Here !',
					'intro_text_2' => 'More choices, better prices, and the easiest way to find your dream car .',
					'intro_title_3' => 'Your Ad Is Not Just a Picture... It is a Story !',
					'intro_text_3' => 'Show it the right way — Professional Ads, Real Reach, Real Results .',
					'site_location' => '123, Homs Syria',
					'siteDescription' => 'Find your dream car with our extensive inventory and trusted sellers.',
					];
							
		DB::table('settings')->insert($setting);
    }
}
