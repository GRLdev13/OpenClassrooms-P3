<?php

namespace App\DTO\User;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

final class ResetPasswordData
{
    public function __construct(
        public string $token,
        public string $email,
        public string $password,
        public string $passwordConfirmation,
    ) {
    }

    public static function fromRequest(Request $request): self
    {
        $validated = $request->validate([
            'token' => ['required', 'string'],
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'confirmed', Password::defaults()],
        ]);

        return new self(
            token: $validated['token'],
            email: $validated['email'],
            password: $validated['password'],
            passwordConfirmation: $request->string('password_confirmation')->toString(),
        );
    }

    public function brokerCredentials(): array
    {
        return [
            'token' => $this->token,
            'email' => $this->email,
            'password' => $this->password,
            'password_confirmation' => $this->passwordConfirmation,
        ];
    }
}
