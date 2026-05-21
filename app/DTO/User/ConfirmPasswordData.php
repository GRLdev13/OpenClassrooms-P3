<?php

namespace App\DTO\User;

use App\Models\User;
use Illuminate\Http\Request;

final class ConfirmPasswordData
{
    public function __construct(
        public User $user,
        public string $password,
    ) {
    }

    public static function fromValidatedData(User $user, array $validated): self
    {
        return new self(
            user: $user,
            password: $validated['password'],
        );
    }

    public static function fromComponent(User $user, object $component): self
    {
        return self::fromValidatedData($user, $component->validate([
            'password' => ['required', 'string'],
        ]));
    }

    public static function fromRequest(User $user, Request $request): self
    {
        return self::fromValidatedData($user, $request->validate([
            'password' => ['required', 'string'],
        ]));
    }

    public function credentials(): array
    {
        return [
            'email' => $this->user->email,
            'password' => $this->password,
        ];
    }
}
