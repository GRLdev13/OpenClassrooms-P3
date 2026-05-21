<?php

namespace App\Controllers\Index;

use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;
use App\Models\Note;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;

class IndexController
{
    /**
     * Endpoint: GET / (route: home)
     */
    public function index(): View|RedirectResponse
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return view('welcome');
    }

    /**
     * Endpoint: GET /login (route: login)
     */
    public function login(): View|RedirectResponse
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return view('user.login');
    }

    /**
     * Endpoint: GET /dashboard (route: dashboard)
     */
    public function dashboard(): View
    {
        return view('dashboard', [
            'notes' => Note::with('tag')->where('user_id', Auth::id())->latest()->get(),
            'tags' => Tag::orderBy('name')->get(),
        ]);
    }
}
