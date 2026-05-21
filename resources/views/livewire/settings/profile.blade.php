<section class="w-full">
    @include('partials.settings-heading')

    <x-settings.layout :heading="__('Profile')" :subheading="__('Update your name and email address')">
        <form method="POST" action="{{ route('user.update') }}" class="my-6 w-full space-y-6">
            @csrf

            <flux:input
                name="name"
                :value="old('name', auth()->user()->name)"
                :label="__('Name')"
                type="text"
                required
                autofocus
                autocomplete="name"
            />

            <div>
                <flux:input
                    name="email"
                    :value="old('email', auth()->user()->email)"
                    :label="__('Email')"
                    type="email"
                    required
                    autocomplete="email"
                />

                @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail &&! auth()->user()->hasVerifiedEmail())
                    <div>
                        <flux:text class="mt-4">
                            {{ __('Your email address is unverified.') }}

                            <flux:link class="text-sm cursor-pointer" wire:click.prevent="resendVerificationNotification">
                                {{ __('Click here to re-send the verification email.') }}
                            </flux:link>
                        </flux:text>

                        @if (session('status') === 'verification-link-sent')
                            <flux:text class="mt-2 font-medium !dark:text-green-400 !text-green-600">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </flux:text>
                        @endif
                    </div>
                @endif
            </div>

            <div class="flex items-center gap-4">
                <div class="flex items-center justify-end">
                    <flux:button variant="primary" type="submit" class="w-full">{{ __('Save') }}</flux:button>
                </div>

                @if (session('status') === 'profile-updated')
                    <p class="text-sm text-green-600">
                        {{ __('Saved.') }}
                    </p>
                @endif
            </div>
        </form>
        @include('livewire.settings.confirm-delete-user-modal')
    </x-settings.layout>
</section>
