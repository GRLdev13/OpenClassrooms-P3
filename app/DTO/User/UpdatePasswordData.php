<?php

namespace App\DTO\User;

use App\Models\User;

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
}
