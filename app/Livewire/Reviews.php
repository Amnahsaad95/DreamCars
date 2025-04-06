<?php

namespace App\Livewire;

use Livewire\Component;

use App\Models\complaintsSuggestions;

class Reviews extends Component
{
	public function getRandomReview()
	{
		return complaintsSuggestions::where('status', 'accepted')
									->where('is_public', 1)->inRandomOrder()->limit(3)->get();
	}
	
    public function render()
    {
        return view('livewire.reviews',['reviews' =>$this->getRandomReview()]);
    }
}
