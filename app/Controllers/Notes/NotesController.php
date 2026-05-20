<?php

namespace App\Controllers\Notes;

use App\Models\Note;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class NotesController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'text' => ['required', 'string'],
            'tag_id' => ['required', 'exists:tags,id'],
        ]);

        Note::create([
            'user_id' => Auth::id(),
            'tag_id' => $validated['tag_id'],
            'text' => $validated['text'],
        ]);

        return back()->with('message', 'Note added.');
    }

    public function destroy(Note $note): RedirectResponse
    {
        abort_unless($note->user_id === Auth::id(), 403);

        $note->delete();

        return back()->with('message', 'Note deleted.');
    }
}
