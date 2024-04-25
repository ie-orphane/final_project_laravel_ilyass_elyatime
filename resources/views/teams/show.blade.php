<x-app-layout>
    <x-slot name="header">
        <div class="relative">
            <h1 id="teamTask" class="text-gray-900 dark:text-gray-100 text-lg relative cursor-pointer">
                {{ $team->name }}
                <svg class=" absolute bottom-1/2 translate-y-1/2 translate-x-[100%] right-0 text-gray-900 dark:text-gray-300 size-4 fill-current"
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                        clip-rule="evenodd" />
                </svg>
            </h1>

            <dialog
                class="absolute bg-transparent m-0 border-none outline-none focus:border-none active:border-none focus:outline-none active:outline-none"
                id="teamTasks">
                <div
                    class="mt-1 text-gray-900 dark:text-gray-300 flex flex-col py-3 bg-white dark:bg-gray-700 rounded-md shadow-sm">
                    @foreach (Auth::user()->teams as $user_team)
                        @if ($user_team != $team)
                            <a class="px-8 py-2 hover:bg-gray-100 dark:hover:bg-gray-800 cursor-pointer text-[15px] text-nowrap"
                                href="{{ route('teams.show', $user_team->id) }}">{{ $user_team->name }}</a>
                        @endif
                    @endforeach
                </div>
            </dialog>
        </div>

        <div class="hidden sm:flex sm:ml-auto sm:gap-6 sm:items-end">
            <div>

                @if (session('error'))
                    <label class="text-red-500 mt-1">{{ __(session('error')) }}</label>
                @endif
                @if (session('success'))
                    <div class="text-green-500 mt-1">{{ __(session('success')) }}</div>
                @endif

                <form action="{{ route('teams.invite', $team->id) }}" method="POST"
                    class="flex border-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 rounded-md shadow-sm has-[:focus]:ring-indigo-500 dark:has-[:focus]:ring-indigo-600 has-[:focus]:border-indigo-500 dark:has-[:focus]:border-indigo-600">
                    @csrf
                    @method('PUT')
                    <input
                        class='block w-full h-full bg-transparent dark:text-gray-300 focus:border-none focus:ring-0 border-none'
                        id="email" type="email" name="email" required autocomplete="email"
                        placeholder="enter user email" />
                    {{-- <x-input-error :messages="$errors->get('email')" class="mt-2" /> --}}

                    <button type="submit" disabled
                        class="flex justify-center items-center px-2 border bg-transparent border-transparent rounded-r-md font-bold text-xs text-white disabled:text-gray-200 dark:text-gray-300 disabled:dark:text-gray-700 uppercase tracking-widest transition ease-in-out duration-150">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                            <path
                                d="M3.478 2.404a.75.75 0 0 0-.926.941l2.432 7.905H13.5a.75.75 0 0 1 0 1.5H4.984l-2.432 7.905a.75.75 0 0 0 .926.94 60.519 60.519 0 0 0 18.445-8.986.75.75 0 0 0 0-1.218A60.517 60.517 0 0 0 3.478 2.404Z" />
                        </svg>
                    </button>
                </form>


            </div>

            <button type="button"
                onclick="taskStart.value = formatDateTime(new Date());taskEnd.value = formatDateTime(new Date());addTaskModal.show()"
                class="flex justify-center h-fit py-2 items-center px-3 gap-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-bold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                <svg class="dark:text-gray-800 text-gray-200" width="16" height="16" fill="currentColor"
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                    <path
                        d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z" />
                </svg>
                Add Task
            </button>

            @include('tasks.partials.create-modal', $data = ['id' => $team->id, 'type' => 'Team'])
        </div>
    </x-slot>
</x-app-layout>

<script>
    window.onclick = function() {
        teamTasks.close();
    };
    teamTask.onclick = function(e) {
        e.stopPropagation();
        teamTasks.show();
    };

    email.addEventListener('input', function(e) {
        this.form.querySelector("button").disabled = this.value == ""
    })
</script>