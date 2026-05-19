<?php

namespace App\Controllers\Index;

use Illuminate\Contracts\View\View;

class IndexController
{
    public function index(): View
    {
        return view('livewire.auth.login');
    }
}
