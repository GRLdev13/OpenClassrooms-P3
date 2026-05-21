<?php
namespace App\Controllers\User;

use App\DTO\User\ConfirmPasswordData;
use App\DTO\User\ResetPasswordData;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password as PasswordBroker;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class PasswordController extends Controller
{
    /**
     * Endpoint: GET /confirm-password (route: password.confirm)
     */
    public function showConfirmPassword(): View
    {
        return view('confirm-password');
    }

    /**
     * Endpoint: POST /confirm-password (route: password.confirm.store)
     */
    public function confirmPassword(Request $request): RedirectResponse
    {
        $user = Auth::user();

        abort_unless($user instanceof User, 403);

        $passwordData = ConfirmPasswordData::fromRequest($user, $request);

        if (! Auth::guard('web')->validate($passwordData->credentials())) {
            throw ValidationException::withMessages([
                'password' => __('auth.password'),
            ]);
        }

        session(['auth.password_confirmed_at' => time()]);

        return redirect()->intended(route('dashboard'));
    }

    /**
     * Endpoint: GET /reset-password/{token} (route: password.reset)
     */
    public function showResetPassword(Request $request, string $token): View
    {
        return view('reset-password', [
            'email' => $request->query('email', ''),
            'token' => $token,
        ]);
    }

    /**
     * Endpoint: POST /reset-password (route: password.update)
     */
    public function resetPassword(Request $request): RedirectResponse
    {
        $passwordData = ResetPasswordData::fromRequest($request);

        $status = PasswordBroker::reset(
            $passwordData->brokerCredentials(),
            function (User $user) use ($passwordData): void {
                $user->forceFill([
                    'password' => Hash::make($passwordData->password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            },
        );

        if ($status !== PasswordBroker::PASSWORD_RESET) {
            throw ValidationException::withMessages([
                'email' => __($status),
            ]);
        }

        return redirect()->route('login')->with('status', __($status));
    }
}
