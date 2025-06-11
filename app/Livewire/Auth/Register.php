<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.empty')]
#[Title('Register')]
/**
 * Register
 */
class Register extends Component
{
    #[Rule('required|string|max:255')]
    public string $name = '';

    #[Rule('required|string|email|max:255|unique:users')]
    public string $email = '';

    #[Rule('required|string|confirmed|min:8')]
    public string $password = '';

    #[Rule('required|string|min:8')]
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate();

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered($user = User::create($validated)));

        Auth::login($user);

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}