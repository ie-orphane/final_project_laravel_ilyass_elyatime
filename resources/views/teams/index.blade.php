<x-app-layout>
    <x-slot name="header">
        <div class="relative">
            <h1 id="teamTask" class="text-gray-900 dark:text-gray-100 text-lg relative cursor-pointer">
                {{ Auth::user()->teams->count() }} Total teams
            </h1>
        </div>

        <div class="hidden sm:flex sm:ml-auto sm:mr-3">
            <button type="button" onclick="addTeamModal.show()"
                class="flex justify-center items-center px-3.5 py-1.5 gap-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-bold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                <svg class="dark:text-gray-800 text-gray-200 size-3" fill="currentColor"
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                    <path
                        d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z" />
                </svg>
                Team
            </button>

            @include('teams.partials.create-modal')
        </div>
    </x-slot>

    <div class="sm:px-6 lg:px-8 py-4 text-gray-900 dark:text-gray-100 flex h-fit flex-wrap gap-4">
        @forelse (Auth::user()->teams as $team)
            <a href="{{ route('teams.show', $team) }}"
                class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg px-4 py-5 flex-[100%] flex-grow-0 sm:flex-grow-0 md:flex-grow-0 lg:flex-grow-0 sm:flex-[calc(calc(100%-calc(1rem))/2)] md:flex-[calc(calc(100%-calc(1rem*2))/3)] lg:flex-[calc(calc(100%-calc(1rem*3))/4)] flex flex-col gap-2">
                <img class="w-full h-full" src="{{ asset($team->image) }}" alt="team background">

                <div class="flex flex-col gap-2 mt-4 text-center">
                    <h5 class="leading-none font-medium text-xl">{{ $team->name }}</h5>
                    <p class="leading-none text-sm font-light opacity-75">
                        {{ $team->members->count() }} Member{{ $team->members->count() > 1 ? 's' : '' }}
                    </p>
                    <h5 class="leading-none font-medium text-xs opacity-75">Created by
                        {{ $team->owner->id == Auth::id() ? 'you' : $team->owner->name }}</h5>
                </div>
            </a>
        @empty
            <div>No Teams avaiblable</div>
        @endforelse
    </div>
</x-app-layout>
