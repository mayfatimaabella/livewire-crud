<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Register extends Component
{
    #[Validate('required|string|max:255')]
    public $name = '';
    
    #[Validate('required|email|unique:users,email')]
    public $email = '';
    
    #[Validate('required|min:8')]
    public $password = '';
    
    #[Validate('required|same:password')]
    public $password_confirmation = '';

    public function register()
    {
        $this->validate();

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        Auth::login($user);

        $this->redirect(route('products.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}
