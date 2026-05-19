<?php

namespace App\Controllers\Index;

use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;
use App\Models\Note;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;

class IndexController
{
    public function index(): View|RedirectResponse
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return view('user.login');
    }

    public function dashboard(): View
    {
        return view('dashboard', [
            'notes' => Note::with('tag')->where('user_id', Auth::id())->latest()->get(),
            'tags' => Tag::orderBy('name')->get(),
        ]);
    }
}
