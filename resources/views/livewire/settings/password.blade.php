
<section class="w-full">
    @include('partials.settings-heading')
    <x-settings.layout :heading="__('Update password')" :subheading="__('Ensure your account is using a long, random password to stay secure')">
        <form method="POST" action="{{ route('settings.password.update') }}" class="mt-6 space-y-6">
            @csrf

            <flux:input
                name="current_password"
                :label="__('Current password')"
                type="password"
                required
                autocomplete="current-password"
            />
            <flux:input
                name="password"
                :label="__('New password')"
                type="password"
                required
                autocomplete="new-password"
            />
            <flux:input
                name="password_confirmation"
                :label="__('Confirm Password')"
                type="password"
                required
                autocomplete="new-password"
            />

            <div class="flex items-center gap-4">
                <div class="flex items-center justify-end">
                    <flux:button variant="primary" type="submit" class="w-full">{{ __('Save') }}</flux:button>
                </div>

                @if (session('status') === 'password-updated')
                    <p class="text-sm text-green-600">
                        {{ __('Saved.') }}
                    </p>
                @endif
            </div>
        </form>
    </x-settings.layout>
</section>
