<?php
namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Http\Requests\RegisterRequest;
use phpDocumentor\Reflection\Types\Nullable;

#[Layout('components.layouts.app')]
class RegisterPage extends Component
{
   public ?string $name = null;
    public ?string $email = null;
    public ?string $password = null;
    public ?string $password_confirmation = null;

    public function register()
    {
        $validated = $this->validate((new RegisterRequest())->rules());

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        Auth::login($user);
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

    
    public function updatedEmail()
    {
        
        if (str_contains($this->email, '@') && str_contains($this->email, '.') && strlen($this->email) > 5) {
            try {
                $this->validateOnly('email', [
                    'email' => 'required|string|email|max:255|unique:users'
                ]);
            } catch (\Illuminate\Validation\ValidationException $e) {
                
            }
        } else {
            
            $this->resetErrorBag('email');
        }
    }

    public function updatedPasswordConfirmation()
    {
        // Only validate password confirmation if both fields have content
        if (!empty($this->password) && !empty($this->password_confirmation)) {
            if ($this->password !== $this->password_confirmation) {
                $this->addError('password_confirmation', 'The password confirmation does not match.');
            } else {
                $this->resetErrorBag('password_confirmation');
            }
        } else if (empty($this->password_confirmation)) {
            // Clear error if confirmation field is empty
            $this->resetErrorBag('password_confirmation');
        }
    }
}