<dialog id="addTeamModal">
    <div class="w-screen h-screen fixed inset-0 bg-black/50 grid place-items-center text-white z-10">
        <div class="bg-white dark:bg-gray-800 px-8 py-6 rounded">
            <form action="{{ route('teams.store') }}" method="POST">
                @csrf
                <p class="block font-medium text-lg text-gray-700 dark:text-gray-300" for="email">
                    Create new Team!
                </p>

                <!-- Name -->
                <div class="mt-6">
                    <x-input-label for="teamName" :value="__('Name')" />
                    <x-input id="teamName" class="block mt-1 w-full" name="name" required />
                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                </div>

                <!-- Description -->
                <div class="mt-6">
                    <x-input-label for="teamDescription" :value="__('Description')" />
                    <x-input id="teamDescription" class="block mt-1 w-full" name="description" required />
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                <div class="mt-6 flex justify-end gap-3 sm:ml-24">
                    <x-danger-button onclick="addTeamModal.close()">{{ __('Cancel') }}</x-danger-button>
                    <x-primary-button>{{ __('Create') }}</x-primary-button>
                </div>
            </form>
        </div>
    </div>
</dialog>
