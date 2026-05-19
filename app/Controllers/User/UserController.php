<?php

namespace App\Controllers\User;

use Livewire\Component;
use App\Models\Tag;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;

 class UserController extends Controller
{
    public function login(): void
    {
        /*
        $this->validate();

        $this->ensureIsNotRateLimited();

        if (! Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true); 
        */
    }

    public function Logout(): void {


    }

    public function register(): void
    {
       
    }

    /**
     * Reset the password for the given user.
     */
    public function resetPassword(): void
    {
      
    }
}
