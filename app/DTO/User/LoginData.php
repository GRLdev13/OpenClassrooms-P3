<?php

namespace App\DTO\User;

use Illuminate\Http\Request;

final class LoginData
{
    public function __construct(
        public string $email,
        public string $password,
        public bool $remember,
    ) {
    }

    public static function fromRequest(Request $request): self
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        return new self(
            email: $validated['email'],
            password: $validated['password'],
            remember: $request->boolean('remember'),
        );
    }

    public function credentials(): array
    {
        return [
            'email' => $this->email,
            'password' => $this->password,
        ];
    }
}
