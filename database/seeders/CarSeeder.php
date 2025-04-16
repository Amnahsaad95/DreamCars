<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Car;
use Illuminate\Support\Facades\DB;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
     public function run(): void
    {
        $cars = [
			[
				'Brand'           => 'هيونداي',
				'car_Model'       => 'إلنترا',
				'car_Year'        => 2018,
				'city'            => 'دمشق',
				'country'         => 'سوريا',
				'car_Image'       => 'cars/Car_1744190500_67f63c245e917.png,cars/Car_1744190500_67f63c245f440.png,cars/Car_1744190500_67f63c245ffb8.png',
				'color'           => '#2c2c2c',
				'car_Price'       => 65000,
				'isSold'          => 0,
				'car_Description' => 'هيونداي إلنترا 2018 بحالة ممتازة.',
				'user_Id'         => 1,
			],
			[
				'Brand'           => 'كيا',
				'car_Model'       => 'سيراتو',
				'car_Year'        => 2017,
				'city'            => 'حلب',
				'country'         => 'سوريا',
				'car_Image'       => 'cars/Car_1744191025_67f63e319360e.jpg,cars/Car_1744191025_67f63e3193cab.png,cars/Car_1744191025_67f63e319434b.jpg',
				'color'           => '#7cc147',
				'car_Price'       => 62000,
				'isSold'          => 0,
				'car_Description' => 'كيا سيراتو 2017، محافظة جيداً.',
				'user_Id'         => 1,
			],
			[
				'Brand'           => 'تويوتا',
				'car_Model'       => 'كورولا',
				'car_Year'        => 2015,
				'city'            => 'حمص',
				'country'         => 'سوريا',
				'car_Image'       => 'cars/Car_1744191831_67f6415798b3a.jpg,cars/Car_1744191831_67f64157998ea.jpg,cars/Car_1744191831_67f641579a3f4.jpg',
				'color'           => '#d4d5d0',
				'car_Price'       => 70000,
				'isSold'          => 0,
				'car_Description' => 'تويوتا كورولا 2015، اقتصادية في استهلاك الوقود.',
				'user_Id'         => 2,
			],
			[
				'Brand'           => 'مرسيدس',
				'car_Model'       => 'C200',
				'car_Year'        => 2012,
				'city'            => 'اللاذقية',
				'country'         => 'سوريا',
				'car_Image'       => 'cars/Car_1744190268_67f63b3cbf755.png,cars/Car_1744190268_67f63b3cc025d.png,cars/Car_1744190268_67f63b3cc0cb1.png',
				'color'           => '#FF0000',
				'car_Price'       => 120000,
				'isSold'          => 0,
				'car_Description' => 'مرسيدس C200 2012، سيارة فاخرة.',
				'user_Id'         => 2,
			],
			[
				'Brand'           => 'بي إم دبليو',
				'car_Model'       => '320i',
				'car_Year'        => 2016,
				'city'            => 'طرطوس',
				'country'         => 'سوريا',
				'car_Image'       => 'cars/Car_1744191132_67f63e9c329df.png,cars/Car_1744191132_67f63e9c33051.jpg,cars/Car_1744191132_67f63e9c3343c.png',
				'color'           => '#9c242d',
				'car_Price'       => 115000,
				'isSold'          => 0,
				'car_Description' => 'بي إم دبليو 320i 2016، رياضية وقوية.',
				'user_Id'         => 3,
			],
			[
				'Brand'           => 'أودي',
				'car_Model'       => 'A4',
				'car_Year'        => 2014,
				'city'            => 'دمشق',
				'country'         => 'سوريا',
				'car_Image'       => 'cars/Car_1744189457_67f638119f08c.png,cars/Car_1744189457_67f63811a3683.png,cars/Car_1744189457_67f63811a3e47.png',
				'color'           => '#f02f02',
				'car_Price'       => 110000,
				'isSold'          => 0,
				'car_Description' => 'أودي A4 2014، جودة ألمانية.',
				'user_Id'         => 3,
			],
			[
				'Brand'           => 'فولكس فاجن',
				'car_Model'       => 'باسات',
				'car_Year'        => 2015,
				'city'            => 'حلب',
				'country'         => 'سوريا',
				'car_Image'       => 'cars/Car_1744191874_67f64182760ae.jpg,cars/Car_1744191874_67f64182774c8.jpg,cars/Car_1744191874_67f6418278032.jpg',
				'color'           => '#4e4e4e',
				'car_Price'       => 95000,
				'isSold'          => 0,
				'car_Description' => 'فولكس فاجن باسات 2015، قيادة مريحة.',
				'user_Id'         => 8,
			],
			[
				'Brand'           => 'فورد',
				'car_Model'       => 'فوكَس',
				'car_Year'        => 2013,
				'city'            => 'حمص',
				'country'         => 'سوريا',
				'car_Image'       => 'cars/Car_1744191689_67f640c93b88d.jpg,cars/Car_1744191689_67f640c93c58d.png,cars/Car_1744191689_67f640c93d285.jpg',
				'color'           => '#ffc600',
				'car_Price'       => 58000,
				'isSold'          => 0,
				'car_Description' => 'فورد فوكَس 2013، خيار موثوق.',
				'user_Id'         => 7,
			],
			[
				'Brand'           => 'شيفروليه',
				'car_Model'       => 'كروز',
				'car_Year'        => 2016,
				'city'            => 'اللاذقية',
				'country'         => 'سوريا',
				'car_Image'       => 'cars/Car_1744191378_67f63f92e2782.jpg,cars/Car_1744191378_67f63f92e0cc3.jpg,cars/Car_1744191378_67f63f92e1acd.jpg',
				'color'           => '#073970',
				'car_Price'       => 60000,
				'isSold'          => 0,
				'car_Description' => 'شيفروليه كروز 2016، بحالة جيدة.',
				'user_Id'         => 7,
			],
			[
				'Brand'           => 'نيسان',
				'car_Model'       => 'صني',
				'car_Year'        => 2017,
				'city'            => 'طرطوس',
				'country'         => 'سوريا',
				'car_Image'       => 'cars/Car_1744190702_67f63ceed0d4d.jpg,cars/Car_1744190702_67f63ceecffdc.jpg,cars/Car_1744190702_67f63ceed0611.jpg',
				'color'           => '#40464f',
				'car_Price'       => 57000,
				'isSold'          => 1,
				'car_Description' => 'نيسان صني 2017، سيارة اقتصادية.',
				'user_Id'         => 7,
			],
			[
				'Brand'           => 'هوندا',
				'car_Model'       => 'سيفيك',
				'car_Year'        => 2018,
				'city'            => 'دمشق',
				'country'         => 'سوريا',
				'car_Image'       => 'cars/Car_1744191615_67f6407fc08c2.jpg,cars/Car_1744191615_67f6407fc1414.png,cars/Car_1744191615_67f6407fc2094.png',
				'color'           => '#f28a00',
				'car_Price'       => 85000,
				'isSold'          => 1,
				'car_Description' => 'هوندا سيفيك 2018، تصميم أنيق.',
				'user_Id'         => 9,
			],
			[
				'Brand'           => 'مازدا',
				'car_Model'       => '3',
				'car_Year'        => 2019,
				'city'            => 'حلب',
				'country'         => 'سوريا',
				'car_Image'       => 'cars/Car_1744191518_67f6401e89ea4.jpg,cars/Car_1744191518_67f6401e8a98f.png,cars/Car_1744191518_67f6401e8b19b.jpg',
				'color'           => '#0084ea',
				'car_Price'       => 93000,
				'isSold'          => 0,
				'car_Description' => 'مازدا 3 2019، اقتصادية وأنيقة.',
				'user_Id'         => 9,
			],
			[
				'Brand'           => 'بيجو',
				'car_Model'       => '3008',
				'car_Year'        => 2020,
				'city'            => 'دمشق',
				'country'         => 'سوريا',
				'car_Image'       => 'cars/Car_1744191923_67f641b33ab4d.jpg,cars/Car_1744191923_67f641b33b784.png,cars/Car_1744191923_67f641b33c692.jpg',
				'color'           => '#030303',
				'car_Price'       => 120000,
				'isSold'          => 0,
				'car_Description' => 'بيجو 3008 2020، SUV فاخرة.',
				'user_Id'         => 9,
			],
		];


        DB::table('cars')->insert($cars);
    }
}


