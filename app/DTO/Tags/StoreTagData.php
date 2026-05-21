<?php

namespace App\DTO\Tags;

use Illuminate\Http\Request;

final class StoreTagData
{
    public function __construct(
        public string $name,
    ) {
    }

    public static function fromRequest(Request $request): self
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:50', 'unique:tags,name'],
        ]);

        return new self(
            name: $validated['name'],
        );
    }

    public function toAttributes(): array
    {
        return [
            'name' => $this->name,
        ];
    }
}
