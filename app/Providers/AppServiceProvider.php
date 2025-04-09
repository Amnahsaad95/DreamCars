<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\View;
use App\Models\Setting;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
		if(!Setting::first()){
			Setting::create([
							'site_name'=>'Dream Cars',
							'sitemail' => 'contact@dreamcars.com',
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
							]);
		}
		if (DB::table('users')->count() == 0) {
            Artisan::call('db:seed', [
                '--class' => 'Database\\Seeders\\UserSeeder'
            ]);
        }
		
		if (DB::table('cars')->count() == 0) {
            Artisan::call('db:seed', [
                '--class' => 'Database\\Seeders\\CarSeeder'
            ]);
        }
		if (DB::table('ads')->count() == 0) {
            Artisan::call('db:seed', [
                '--class' => 'Database\\Seeders\\AdsSeeder'
            ]);
        }
		if (DB::table('complaints_suggestions')->count() == 0) {
            Artisan::call('db:seed', [
                '--class' => 'Database\\Seeders\\ComplaintSeeder'
            ]);
        }
		View::share('settings', Setting::first());

    }
}
