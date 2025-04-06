<?php

namespace App\Livewire;

use Livewire\Component;

class SubscriptionList extends Component
{
    
	public $subscriptions = [
		[
			'Id'=> 1,
			'name' => 'Basic Plan',
			'price' => 10,
			'features' => ['Add up to 5 cars', 'Standard support', 'Limited search visibility']
		],
		[
			'Id'=> 2,
			'name' => 'Premium Plan',
			'price' => 25,
			'features' => ['Add up to 20 cars', 'Priority support', 'Enhanced search visibility']
		],
		[
			'Id'=> 3,
			'name' => 'Professional Plan',
			'price' => 50,
			'features' => ['Unlimited car listings', 'VIP support', 'Top search ranking']
		],
	];

	
	public function render()
    {
        return view('livewire.subscription-list');
    }
}
