<?php

namespace App\Livewire\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Validate;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;

use Livewire\Component;

#[Layout('components.layouts.empty')]
// <-- Here is the `empty` layout
#[Title('Login')]
/**
 * Login
 */
class Login extends Component
{

    #[Validate('required|string|email')]

    /**
     * Summary of email
     *
     * @var string
     */
    public string $email = '';

    #[Validate('required|string')]

    /**
     * Summary of password
     *
     * @var string
     */
    public string $password = '';

    /**
     * Summary of remember me
     *
     * @var string
     */
    public bool $remember = false;


    /**
     * The mount function
     *
     * @return mixed
     */
    public function mount()
    {
        /**
         * @disregard P1013 Undefined type
        */
        if (auth()->user()) {
            return redirect('/');
        }
    }//end mount()


    /**
     * Handle an incoming authentication request.
     *
     * @throws ValidationException Throws validation exception.
     * @return void
     */
    public function login(): void
    {
        $this->validate();

        $this->ensureIsNotRateLimited();

        if (!Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
        Session::regenerate();

        $this->redirectIntended(default: route(name: 'dashboard', absolute: false), navigate: true);
    }//end login()


    /**
     * Ensure the authentication request is not rate limited.
     *
     * @throws ValidationException Throws validation exception.
     * @return void
     */
    protected function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => __('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }//end ensureIsNotRateLimited()


    /**
     * Get the authentication rate limiting throttle key.
     *
     * @return string
     */
    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->email).'|'.request()->ip());
    }//end throttleKey()


}//end class
