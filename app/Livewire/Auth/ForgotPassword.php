<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Component;
use Mary\Traits\Toast;

#[Layout('components.layouts.empty')]
#[Title('Forgot Password')]
class ForgotPassword extends Component
{
    use Toast;

    #[Rule('required|string|email')]
    public string $email = '';

    public bool $emailSent = false;

    public function sendResetLink(): void
    {
        $this->validate();

        $status = Password::sendResetLink(['email' => $this->email]);

        if ($status === Password::RESET_LINK_SENT) {
            $this->emailSent = true;
            $this->success('Password reset link sent to your email!');
        } else {
            $this->error('Unable to send password reset link. Please try again.');
        }
    }

    public function render()
    {
        return view('livewire.auth.forgot-password');
    }
}