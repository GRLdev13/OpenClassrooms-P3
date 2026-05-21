<?php

namespace App\DTO\User;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

final class UpdatePasswordData
{
    public function __construct(
        public User $user,
        public string $currentPassword,
        public string $password,
        public string $passwordConfirmation,
    ) {
    }

    public static function fromValidatedData(User $user, array $validated): self
    {
        return new self(
            user: $user,
            currentPassword: $validated['current_password'],
            password: $validated['password'],
            passwordConfirmation: $validated['password_confirmation'],
        );
    }

    public static function fromRequest(User $user, Request $request): self
    {
        $validated = $request->validate([
            'current_password' => ['required', 'string', 'current_password'],
            'password' => ['required', 'string', Password::defaults(), 'confirmed'],
            'password_confirmation' => ['required', 'string'],
        ]);

        return self::fromValidatedData($user, $validated);
    }
}
