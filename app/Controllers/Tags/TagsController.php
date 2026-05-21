<?php

namespace App\Controllers\Tags;

use App\DTO\Tags\StoreTagData;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class TagsController extends Controller
{
    /**
     * Endpoint: POST /tags (route: tags.store)
     */
    public function store(Request $request): RedirectResponse
    {
        $tagData = StoreTagData::fromRequest($request);

        Tag::create($tagData->toAttributes());

        return back()->with('message', 'Tag added!');
    }
}
