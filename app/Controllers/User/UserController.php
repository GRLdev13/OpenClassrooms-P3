<?php

namespace App\Controllers\User;

use App\DTO\User\LoginData;
use App\DTO\User\RegisterUserData;
use App\DTO\User\UpdateUserData;
use App\Livewire\Actions\Logout;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    /**
     * Endpoint: POST /login (route: login)
     */
    public function login(Request $request): RedirectResponse
    {
        $loginData = LoginData::fromRequest($request);

        if (! Auth::attempt($loginData->credentials(), $loginData->remember)) {
            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        $request->session()->regenerate();

        return redirect()->intended(route('dashboard'));
    }

    /**
     * Endpoint: POST /logout (route: logout)
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    /**
     * Endpoint: GET /register (route: register)
     */
    public function showRegister(): View|RedirectResponse
    {
        return view('user.settings.register');
    }

    /**
     * Endpoint: POST /register (route: register.store)
     */
    public function register(Request $request): RedirectResponse
    {
        $registerData = RegisterUserData::fromRequest($request);

        event(new Registered($user = User::create($registerData->toUserAttributes())));

        Auth::login($user);

        $request->session()->regenerate();

        return redirect()->intended(route('dashboard'));
    }

     /**
     * Endpoint: DELETE /user (route: user)
     */
    public function deleteUser(Logout $logout): RedirectResponse
    {
        //check if password is correct
       $user = Auth::user();
       $logout(); // Perform some side effect
       $user->delete(); // Now perform the deletion

        // Auth::user()->delete();
        // $this->redirect('/', navigate: true);
        return redirect()->route('index');
    }

    /**
     * Endpoint: POST /Update (route: user.update)
     */
    public function updateUser(Request $request): RedirectResponse
    {
        $user = $request->user();

        abort_unless($user instanceof User, 403);

        $updateUserData = UpdateUserData::fromRequest($user, $request);

        $attributes = $updateUserData->toUserAttributes();

        if ($updateUserData->emailHasChanged()) {
            $attributes['email_verified_at'] = null;
        }

        $updateUserData->user->forceFill($attributes)->save();

        return back()->with('status', 'profile-updated');
    }
}
