<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactUsMail;


class ContactUs extends Component
{
	
	public $name;
    public $email;
    public $message;
    public $successMessage = '';



    public function render()
    {
        return view('livewire.contact-us');
    }
}
