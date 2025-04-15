<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Crypt;

use Illuminate\Support\Facades\URL;
class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
		//dd('mmid');
        /*if(session()->has('locale')){
            app()->setLocale(session('locale', config('app.locale')));
			dd('mmid');
			$locale = session('locale', config('app.locale'));
			app()->setLocale($locale);
        }
		else{
			app()->setLocale('ar');
		}
		Cookie::queue(Cookie::forget('locale'));
		Cookie::queue(Cookie::make('locale', 'ar', 60 * 24 * 30,null, null, false, false));
		  $cookie = Cookie::make('my_cookie', 'hello_world', 60); 
		//cookie('lang', 'ar', 60);
		//$language = session('locale', request()->cookie('locale', config('app.locale')));
		//  cookie()->queue(Cookie::make('locale', 'ar', 60 * 24 * 365, null, null, false, false));
		//  session(['locale' => 'en']);
		//  $locale = request()->cookie('locale', config('app.locale')); 
		/*  dd(Cookie::get('locale'));
		//session(['locale' => config('app.locale')]);
        if (session()->has('locale')) {
			dd("I am here ".session('locale'));
            app()->setLocale(session('locale'));
        }else{
			//dd(config('app.locale'));
			 //$locale = session('locale', config('app.locale'));
			// session()->flash('locale', config('app.locale'));
			 session(['locale' => config('app.locale')]);
			// dd( session('locale'));
			app()->setLocale('ar');
		}
*/
		//if (session()->has('locale')) 
			//app()->setLocale(session('locale'));
		//else{
			//$locale = session()->get('locale', 'ar');
			//App::setLocale('ar');
		//}
       // Session::put('locale', $locale);
		
       // App::setLocale($locale);
		//dd($request->route('locale'));
		/*if ($locale = $request->route('locale')) {
            app()->setLocale($locale);
	}else{
		app()->setLocale($locale);
	URL::defaults(['locale' => config('app.locale')]); }
		*/
		
		app()->setLocale($request->segment(1));
 
        URL::defaults(['locale' => $request->segment(1)]);

        return $next($request);
    }
}
