<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule; 
use Livewire\Component;

#[Layout('components.layouts.app')]
class RegisterPage extends Component
{
    #[Rule('required|string|max:255')]
    public ?string $name = null;


    #[Rule('required|string|email|max:255|unique:users', onUpdate: false)]
    public ?string $email = null;

    #[Rule('required|string|min:8|confirmed')]
    public ?string $password = null;

    public ?string $password_confirmation = null;

    public function register()
    {
        $validated = $this->validate();

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        Auth::login($user);

        session()->regenerate();

        return $this->redirect('/');
    }

    public function passwordStrength()
    {
        $password = $this->password;
        $strength = 0;
        
        if (strlen($password) >= 8) $strength++; 
        if (preg_match('/[A-Z]/', $password)) $strength++; 
        if (preg_match('/[0-9]/', $password)) $strength++; 
        if (preg_match('/[\W_]/', $password)) $strength++; 
        
        return $strength; 
    }

    public function render()
    {
        return view('livewire.auth.register-page');
    }
}