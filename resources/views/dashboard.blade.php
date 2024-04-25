<x-app-layout>
    <x-slot name="header">
        <div class="hidden sm:flex sm:ml-auto sm:mr-3">
            <button type="button" onclick="addTeamModal.show()"
                class="flex justify-center items-center px-3.5 py-1.5 gap-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-bold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                <svg class="dark:text-gray-800 text-gray-200 size-3" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 448 512">
                    <path
                        d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z" />
                </svg>
                Team
            </button>

            @include('teams.partials.create-modal')
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-4 h-full w-full">
        <div
            class="bg-white h-full w-full dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900 dark:text-gray-100">
            <div id="calendar" class="h-full"></div>

            @include('tasks.partials.create-modal', $data)
            @include('tasks.partials.update-modal')            
        </div>
    </div>
</x-app-layout>

@vite('resources/js/calender.js')