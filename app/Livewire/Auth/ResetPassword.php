<?php

namespace App\Livewire\Auth;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Component;
use Mary\Traits\Toast;

#[Layout('components.layouts.empty')]
#[Title('Reset Password')]
class ResetPassword extends Component
{
    use Toast;

    public string $token = '';
    
    #[Rule('required|string|email')]
    public string $email = '';

    #[Rule('required|string|confirmed|min:8')]
    public string $password = '';

    #[Rule('required|string|min:8')]
    public string $password_confirmation = '';

    public function mount(string $token): void
    {
        $this->token = $token;
        $this->email = request()->query('email', '');
    }

    public function resetPassword(): void
    {
        $this->validate();

        $status = Password::reset(
            [
                'email' => $this->email,
                'password' => $this->password,
                'password_confirmation' => $this->password_confirmation,
                'token' => $this->token,
            ],
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            $this->success('Password reset successfully!');
            $this->redirectRoute('login');
        } else {
            $this->error('Unable to reset password. Please try again.');
        }
    }

    public function render()
    {
        return view('livewire.auth.reset-password');
    }
}