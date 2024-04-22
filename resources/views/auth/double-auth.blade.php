<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('double-auth.store') }}">
        @csrf

        <!-- Verification code -->
        <div>
            <x-input-label for="verification_code" :value="__('Verification Code')" />
            <x-text-input id="verification_code" class="block mt-1 w-full" type="text" name="verification_code" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('verification_code')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-3">
                {{ __('Confirm') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
