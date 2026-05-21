<?php

namespace App\DTO\User;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

final class RegisterUserData
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password,
        public string $passwordConfirmation,
    ) {
    }

    public static function fromRequest(Request $request): self
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Password::defaults()],
        ]);

        return new self(
            name: $validated['name'],
            email: $validated['email'],
            password: $validated['password'],
            passwordConfirmation: $request->string('password_confirmation')->toString(),
        );
    }

    public function toUserAttributes(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ];
    }
}
