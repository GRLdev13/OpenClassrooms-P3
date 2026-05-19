<?php

namespace App\Controllers\Tags;

use App\Models\Tag;

class TagsController
{
    public $name = '';

    protected $rules = [
        'name' => 'required|string|max:50|unique:tags,name',
    ];

    public function save()
    {
        $this->validate();

        Tag::create(['name' => $this->name]);

        $this->reset('name');

        $this->dispatch('tagCreated');

        session()->flash('message', 'Tag added!');
    }

    public function render()
    {
        return view('livewire.tag-form');
    }
}
