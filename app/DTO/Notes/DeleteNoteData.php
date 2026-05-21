<?php

namespace App\DTO\Notes;

use App\Models\Note;

final class DeleteNoteData
{
    public function __construct(
        public Note $note,
        public int $userId,
    ) {
    }

    public static function fromRoute(Note $note, int $userId): self
    {
        return new self(
            note: $note,
            userId: $userId,
        );
    }

    public function belongsToUser(): bool
    {
        return $this->note->user_id === $this->userId;
    }
}
