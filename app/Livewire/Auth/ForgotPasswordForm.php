<?php

namespace App\Livewire\Auth;

use Livewire\Component;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ForgotPasswordForm extends Component
{
	public $email;
    public $resetLink;

    public function sendLink()
    {
        $this->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        $token = Str::random(60);

        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $this->email],
            ['token' => $token, 'created_at' => now()]
        );

        $this->resetLink = route('reset.password', $token);
    }

    public function render()
    {
        return view('livewire.auth.forgot-password-form')
			 ->layout('components.layouts.auth', ['title' => 'Forget Password']);
    }
}
