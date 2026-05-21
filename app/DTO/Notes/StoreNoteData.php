<?php

namespace App\DTO\Notes;

use Illuminate\Http\Request;

final class StoreNoteData
{
    public function __construct(
        public int $userId,
        public int $tagId,
        public string $text,
    ) {
    }

    public static function fromRequest(Request $request, int $userId): self
    {
        $validated = $request->validate([
            'text' => ['required', 'string'],
            'tag_id' => ['required', 'exists:tags,id'],
        ]);

        return new self(
            userId: $userId,
            tagId: (int) $validated['tag_id'],
            text: $validated['text'],
        );
    }

    public function toAttributes(): array
    {
        return [
            'user_id' => $this->userId,
            'tag_id' => $this->tagId,
            'text' => $this->text,
        ];
    }
}
