<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    
		'accepted' => 'يجب قبول :attribute.',
		'accepted_if' => 'يجب قبول :attribute في حالة :other يساوي :value.',
		'active_url' => 'حقل :attribute لا يُمثّل رابطًا صحيحًا.',
		'after' => 'يجب على حقل :attribute أن يكون تاريخًا لاحقًا للتاريخ :date.',
		'after_or_equal' => 'حقل :attribute يجب أن يكون تاريخاً لاحقاً أو مطابقاً للتاريخ :date.',
		'alpha' => 'يجب أن لا يحتوي حقل :attribute سوى على حروف.',
		'alpha_dash' => 'يجب أن لا يحتوي حقل :attribute سوى على حروف، أرقام ومطّات.',
		'alpha_num' => 'يجب أن يحتوي حقل :attribute على حروفٍ وأرقامٍ فقط.',
		'array' => 'يجب أن يكون حقل :attribute ًمصفوفة.',
		'ascii' => 'يجب أن يحتوي الحقل :attribute فقط على أحرف أبجدية رقمية أحادية البايت ورموز.',
		'attached' => 'حقل :attribute تم إرفاقه بالفعل.',
		'before' => 'يجب على حقل :attribute أن يكون تاريخًا سابقًا للتاريخ :date.',
		'before_or_equal' => 'حقل :attribute يجب أن يكون تاريخا سابقا أو مطابقا للتاريخ :date.',
		'between' => [
			'array' => 'يجب أن يحتوي حقل :attribute على عدد من العناصر بين :min و :max.',
			'file' => 'يجب أن يكون حجم ملف حقل :attribute بين :min و :max كيلوبايت.',
			'numeric' => 'يجب أن تكون قيمة حقل :attribute بين :min و :max.',
			'string' => 'يجب أن يكون عدد حروف نّص حقل :attribute بين :min و :max.',
		],
		'boolean' => 'يجب أن تكون قيمة حقل :attribute إما true أو false .',
		'confirmed' => 'حقل التأكيد غير مُطابق للحقل :attribute.',
		'current_password' => 'كلمة المرور غير صحيحة.',
		'date' => 'حقل :attribute ليس تاريخًا صحيحًا.',
		'date_equals' => 'يجب أن يكون حقل :attribute مطابقاً للتاريخ :date.',
		'date_format' => 'لا يتوافق حقل :attribute مع الشكل :format.',
		'declined' => 'يجب رفض :attribute.',
		'different' => 'يجب أن يكون الحقلان :attribute و :other مُختلفين.',
		'digits' => 'يجب أن يحتوي حقل :attribute على :digits رقمًا/أرقام.',
		'digits_between' => 'يجب أن يحتوي حقل :attribute بين :min و :max رقمًا/أرقام .',
		'email' => 'يجب أن يكون حقل :attribute عنوان بريد إلكتروني صحيح البُنية.',
		'exists' => 'قيمة الحقل :attribute غير موجودة.',
		'file' => 'الحقل :attribute يجب أن يكون ملفا.',
		'filled' => 'حقل :attribute إجباري.',
		'gt' => [
			'array' => 'يجب أن يحتوي حقل :attribute على أكثر من :value عناصر/عنصر.',
			'file' => 'يجب أن يكون حجم ملف حقل :attribute أكبر من :value كيلوبايت.',
			'numeric' => 'يجب أن تكون قيمة حقل :attribute أكبر من :value.',
			'string' => 'يجب أن يكون طول نّص حقل :attribute أكثر من :value حروفٍ/حرفًا.',
		],
		'gte' => [
			'array' => 'يجب أن يحتوي حقل :attribute على الأقل على :value عُنصرًا/عناصر.',
			'file' => 'يجب أن يكون حجم ملف حقل :attribute على الأقل :value كيلوبايت.',
			'numeric' => 'يجب أن تكون قيمة حقل :attribute مساوية أو أكبر من :value.',
			'string' => 'يجب أن يكون طول نص حقل :attribute على الأقل :value حروفٍ/حرفًا.',
		],
		'image' => 'يجب أن يكون حقل :attribute صورةً.',
		'in' => 'قيمة حقل :attribute غير موجودة في قائمة القيم المسموح بها.',
		'integer' => 'يجب أن يكون حقل :attribute عددًا صحيحًا.',
		'ip' => 'يجب أن يكون حقل :attribute عنوان IP صحيحًا.',
		'ipv4' => 'يجب أن يكون حقل :attribute عنوان IPv4 صحيحًا.',
		'ipv6' => 'يجب أن يكون حقل :attribute عنوان IPv6 صحيحًا.',
		'json' => 'يجب أن يكون حقل :attribute نصًا من نوع JSON.',
		'max' => [
			'array' => 'يجب أن لا يحتوي حقل :attribute على أكثر من :max عناصر/عنصر.',
			'file' => 'يجب أن لا يتجاوز حجم ملف حقل :attribute :max كيلوبايت.',
			'numeric' => 'يجب أن تكون قيمة حقل :attribute مساوية أو أصغر من :max.',
			'string' => 'يجب أن لا يتجاوز طول نّص حقل :attribute :max حروفٍ/حرفًا.',
		],
		'min' => [
			'array' => 'يجب أن يحتوي حقل :attribute على الأقل على :min عُنصرًا/عناصر.',
			'file' => 'يجب أن يكون حجم ملف حقل :attribute على الأقل :min كيلوبايت.',
			'numeric' => 'يجب أن تكون قيمة حقل :attribute مساوية أو أكبر من :min.',
			'string' => 'يجب أن يكون طول نص حقل :attribute على الأقل :min حروفٍ/حرفًا.',
		],
		'not_in' => 'يجب ألا يكون حقل :attribute موجودًا في القائمة.',
		'numeric' => 'يجب على حقل :attribute أن يكون رقمًا.',
		'regex' => 'يجب أن تحتوي كلمة المرور على حرف واحد على الأقل، وأحرف كبيرة وصغيرة، ورقم واحد على الأقل',
		'required' => 'حقل :attribute مطلوب.',
		'string' => 'يجب أن يكون حقل :attribute نصًا.',
		'unique' => 'قيمة الحقل :attribute مستخدمة من قبل.',
		'url' => 'صيغة رابط حقل :attribute غير صحيحة.',
		"user"=>"لم يتم العثور على أيّ حسابٍ بهذا العنوان الإلكتروني.",
		"uuid"=> "حقل :attribute يجب أن يكون بصيغة UUID سليمة.",
		'password.required' => 'كلمة المرور مطلوبة',
		'password.confirmed' => 'تأكيد كلمة المرور غير مطابق',
		'password.min' => 'يجب أن تكون كلمة المرور 8 أحرف على الأقل',
		'password.regex' => 'يجب أن تحتوي كلمة المرور على حرف واحد على الأقل، وأحرف كبيرة وصغيرة، ورقم واحد على الأقل',
		'car_Image.*.image' => 'يجب أن يكون الملف صورة.',
		'car_Image.*.mimes' => 'يجب أن تكون الصورة من نوع: jpeg، png، jpg، gif.',
		'car_Image.*.max' => 'الحد الأقصى لحجم الصورة هو 2 ميجابايت.',



    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
    'commentPhone' => 'رقم الهاتف',
    'phone' => 'رقم الهاتف',
    'name' => 'الاسم',
    'newComment' => 'التعليق',
    'email' => 'الايميل',
    'password' => 'كلمة السر',
    'new_password' => 'كلمة السر الجديدة',
	'password_confirmation'=>'تأكيد كلمة السر',
	///car
	'Brand' => 'العلامة التجارية',
    'car_Model' => 'الموديل',
    'car_Year' => 'السنة',
    'car_Price' => 'السعر',
    'color' => 'اللون',
    'status' => 'الحالة',
    'city' => 'المدينة',
    'country' => 'الدولة',
    'car_Description' => 'الوصف',
	///ads
    'FullName'   => 'الاسم الكامل',
	'image'      => 'صورة الإعلان',
	'url'        => 'الرابط المستهدف',
	'end_date'   => 'تاريخ الانتهاء',
	'start_date' => 'تاريخ البدء',
	'location'   => 'الموقع',
	'content'   => 'محتوى ',

	
	],

];
