<?php


namespace App\Livewire\Auth;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Register extends Component
{
    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $terms = false;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => ['required','min:8','confirmed','regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&]).+$/'],
        'terms' => 'accepted',
    ];

    public function submit()
    {
        $this->validate();

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        Auth::login($user);

        return redirect()->route('register.details');
    }

    public function render()
    {
        return view('livewire.auth.register')
            ->layout('components.layouts.auth', ['title' => 'Register']);
    }
}
