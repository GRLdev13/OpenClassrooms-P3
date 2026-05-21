<?php

namespace App\Controllers\User;

use App\DTO\User\LoginData;
use App\DTO\User\RegisterUserData;
use App\DTO\User\UpdatePasswordData;
use App\Livewire\Actions\Logout;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserProfileController extends Controller
{
    public function profile(): View
    {
        return redirect()->route('profile');
    }
}
?>