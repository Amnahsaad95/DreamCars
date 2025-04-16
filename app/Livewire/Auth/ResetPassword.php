<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use App\Models\User;

class ResetPassword extends Component
{
    public $token;
    public $email;
    public $password;
    public $password_confirmation;

	
    public function mount($token)
	
    {
        $this->token = $token;

        $data = DB::table('password_reset_tokens')->where('token', $token)->first();

        if(!$data) {
            abort(404);
        }

        $this->email = $data->email;
    }

    public function resetPassword()
    {
        $this->validate([
            'password' => ['required','min:8','confirmed','regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&]).+$/'],
        ]);
		
		
        User::where('email', $this->email)->update([
            'password' => Hash::make($this->password),
        ]);

        DB::table('password_reset_tokens')->where('token', $this->token)->delete();

        //session()->flash('message', 'Password Changed Successfully');
        return redirect()->route('login',['locale' => app()->getLocale()]);
    }

    public function render()
    {
        return view('livewire.auth.reset-password')
			->layout('components.layouts.auth', ['title' => 'Reset Password']);
    }
}
