<dialog id="updateTaskModal">
    <div class="w-screen h-screen fixed inset-0 bg-black/50 grid place-items-center text-white z-10">
        <div class="relative bg-white dark:bg-gray-800 px-6 py-8 rounded">
            <form method="POST" action="{{ route('tasks.update') }}">
                @csrf
                @method('PUT')
                <p class="block font-medium text-lg text-gray-700 dark:text-gray-300" for="email">
                    Update Task!
                </p>

                <!-- Id -->
                <x-input id="updateTaskId" class="hidden" name="id" required />

                <!-- Name -->
                <div class="mt-6">
                    <x-input-label for="updateTaskName" :value="__('Name')" />
                    <x-input id="updateTaskName" class="block mt-1 w-full" name="title" required />
                    <x-input-error :messages="$errors->get('updateTaskName')" class="mt-2" />
                </div>

                <!-- Description -->
                <div class="mt-6">
                    <x-input-label for="updateTaskDescription" :value="__('Description')" />
                    <x-input id="updateTaskDescription" class="block mt-1 w-full" name="description" required />
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                <div class="mt-6 flex gap-4">
                    <!-- Start -->
                    <div>
                        <x-input-label for="updateTaskStart" :value="__('Start')" />
                        <x-input class="block mt-1 w-full" type="datetime-local" name="start" required
                            id="updateTaskStart" />
                        <x-input-error :messages="$errors->get('updateTaskStart')" class="mt-2" />
                    </div>

                    <!-- End -->
                    <div>
                        <x-input-label for="updateTaskEnd" :value="__('End')" />
                        <x-input class="block mt-1 w-full" type="datetime-local" name="end" required
                            id="updateTaskEnd" />
                        <x-input-error :messages="$errors->get('updateTaskEnd')" class="mt-2" />
                    </div>
                </div>

                <div class="mt-4 relative">
                    <x-input-label for="updateTaskPriority" :value="__('Priority')" />
                    <div class="relative" onclick="updatePriorityModal.show()">
                        <input
                            class="cursor-pointer mt-1 w-full focus:outline-none border-gray-300 dark:border-gray-700 outline-none dark:bg-gray-900 text-gray-900 dark:text-gray-300 rounded-md shadow-sm"
                            name="priority" id="updateTaskPriority" value="low" required readonly />

                        <svg class="cursor-pointer absolute bottom-1/2 translate-y-1/2 -translate-x-1/2 right-0 text-gray-900 dark:text-gray-300 size-5"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>

                    <dialog class="m-0 w-full bg-transparent" id="updatePriorityModal">
                        <div
                            class="mt-1 border border-gray-300 dark:border-gray-700 text-gray-900 bg-white dark:bg-gray-800 dark:text-gray-300 rounded-md shadow-sm">
                            @foreach (['low', 'medium', 'high', 'critical'] as $index => $priority)
                                <div onclick="updateTaskPriority.value = '{{ $priority }}';updatePriorityModal.close()"
                                    class="{{ $index != 0 ? 'border-t' : '' }} border-gray-300 px-6 dark:border-gray-700 py-2 cursor-pointer">
                                    {{ $priority }}</div>
                            @endforeach
                        </div>
                    </dialog>
                    <x-input-error :messages="$errors->get('end')" class="mt-2" />
                </div>

                <div class="mt-6 flex justify-end gap-3">
                    <x-danger-button type="button"
                        onclick="updateTaskModal.close()">{{ __('Cancel') }}</x-danger-button>
                    <x-primary-button>{{ __('Confirm') }}</x-primary-button>
                </div>
            </form>
        </div>
    </div>
</dialog>
