<?php

namespace App\DTO\User;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

final class UpdateUserData
{
    public function __construct(
        public User $user,
        public string $name,
        public string $email,
    ) {
    }

    public static function fromRequest(User $user, Request $request): self
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($user->id),
            ],
        ]);

        return new self(
            user: $user,
            name: $validated['name'],
            email: $validated['email'],
        );
    }

    public function emailHasChanged(): bool
    {
        return $this->user->email !== $this->email;
    }

    public function toUserAttributes(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
        ];
    }
}
