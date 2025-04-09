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
			Setting::create(['site_name'=>'Dream Cars']);
		}
		if (DB::table('cars')->count() == 0) {
            Artisan::call('db:seed', [
                '--class' => 'Database\\Seeders\\CarSeeder'
            ]);
        }
		View::share('settings', Setting::first());

    }
}
