<dialog id="inviteModal">
    <div class="w-screen h-screen fixed inset-0 bg-black/50 grid place-items-center text-white z-10">
        <div class="bg-white dark:bg-gray-800 py-6 px-8 rounded">
            <form action="{{ route('teams.store') }}" method="POST">
                @csrf
                <p class="block font-medium text-lg text-gray-700 dark:text-gray-300" for="email">
                    Create new Team!
                </p>

                <!-- Email -->
                <div class="mt-6">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class='block mt-1 w-full' type="email" name="email"
                        required autocomplete="email" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="mt-6 flex justify-end gap-3 sm:ml-24">
                    <x-danger-button onclick="inviteModal.close()">{{ __('Cancel') }}</x-danger-button>
                    <x-primary-button>{{ __('Create') }}</x-primary-button>
                </div>
            </form>
        </div>
    </div>
</dialog>
