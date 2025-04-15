<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    
	public function changeLanguage($lang)
    {
	// تحقق من اللغات المدعومة فقط
        if (!in_array($lang, ['en', 'ar'])) {
            $lang = config('app.locale'); // استخدم اللغة الافتراضية إذا غير مدعومة
        }

        session(['locale' => $lang]);
		//dd( session('locale'));
        app()->setLocale($lang);
		
		dd( app()->getLocale());
		 $this->redirect(request()->header('Referer'), navigate: true);

    }
}
