<?php

namespace App\Controllers\Notes;

use App\DTO\Notes\DeleteNoteData;
use App\DTO\Notes\StoreNoteData;
use App\Models\Note;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class NotesController extends Controller
{
    /**
     * Endpoint: POST /notes (route: notes.store)
     */
    public function store(Request $request): RedirectResponse
    {
        $noteData = StoreNoteData::fromRequest($request, (int) Auth::id());

        Note::create($noteData->toAttributes());

        return back()->with('message', 'Note added.');
    }

    /**
     * Endpoint: DELETE /notes/{note} (route: notes.destroy)
     */
    public function destroy(Note $note): RedirectResponse
    {
        $noteData = DeleteNoteData::fromRoute($note, (int) Auth::id());

        abort_unless($noteData->belongsToUser(), 403);

        $noteData->note->delete();

        return back()->with('message', 'Note deleted.');
    }
}
