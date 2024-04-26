<x-app-layout>
    <x-slot name="header">
        <div class="relative">
            <div class="flex gap-3">
                <img class="size-5 rounded-full" src="{{ asset($team->image) }}" alt="team background">
                <h1 id="teamTask" class="text-gray-900 dark:text-gray-100 text-lg relative cursor-pointer">
                    {{ $team->name }}
                    <svg class=" absolute bottom-1/2 translate-y-1/2 translate-x-[100%] right-0 text-gray-900 dark:text-gray-300 size-4 fill-current"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </h1>
            </div>

            <dialog
                class="absolute bg-transparent m-0 border-none outline-none focus:border-none active:border-none focus:outline-none active:outline-none"
                id="teamTasks">
                <div
                    class="mt-1 text-gray-900 dark:text-gray-300 w-full flex flex-col py-2 bg-white dark:bg-gray-700 rounded-md shadow-sm">
                    @foreach (Auth::user()->teams as $user_team)
                        @if ($user_team->id != $team->id)
                            <a class="flex w-full gap-3 pl-5 pr-10 py-2 hover:bg-gray-100 dark:hover:bg-gray-800 cursor-pointer text-[15px] text-nowrap"
                                href="{{ route('teams.show', $user_team->id) }}">
                                <img class="size-5 rounded-full" src="{{ asset($user_team->image) }}"
                                    alt="team background">
                                <span>{{ $user_team->name }}</span>
                            </a>
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

    <div class="flex sm:px-4 flex-col lg:flex-row lg:px-6 py-4 h-full w-full gap-5">
        <div
            class="bg-white dark:bg-gray-800 shadow-sm overflow-hidden sm:rounded-lg text-gray-900 dark:text-gray-100 flex-[75%] lg:h-fit py-6">

            <div class="flex flex-col w-full items-center h-full gap-3">
                <div class="h-[200px] w-11/12 rounded-md">
                    <img class="w-full h-full" src="{{ asset($team->image) }}" alt="">
                </div>

                <div class="flex flex-col gap-3 w-[66%]">
                    <div class="flex gap-20">
                        <div class="">
                            <h6 class="capitalize font-bold text-lg">Created by</h6>
                            <p class="ml-2 text-gray-900 dark:text-gray-400">{{ $team->owner->name }}</p>
                        </div>

                        <div class="">
                            <h6 class="capitalize font-bold text-lg">description</h6>
                            <p class="ml-2 text-gray-900 dark:text-gray-400">{{ $team->description }}</p>
                        </div>
                    </div>

                    <div class="flex gap-20">
                        <div class="">
                            @if ($team->members->count() > 1)
                                <h6 class="capitalize font-bold text-lg">members</h6>
                                @foreach ($team->members as $member)
                                    @if ($team->owner->id != $member->id)
                                        <p class="ml-2 text-gray-900 dark:text-gray-400">{{ $member->name }}</p>
                                    @endif
                                @endforeach
                            @endif
                        </div>

                        <div class="">
                            @if ($team->tasks)
                                <h6 class="capitalize font-bold text-lg">Tasks</h6>
                                <div class="flex flex-col gap-1 ml-2 group">
                                    @foreach ($team->tasks as $task)
                                        <div class="flex gap-2 items-center">
                                            @switch($task->status)
                                                @case('to do')
                                                    <form action="{{ route('tasks.update', $task->id) }}" method="post">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="submit"
                                                            class="size-3 border text-transparent cursor-pointer flex border-gray-600 rounded-md"
                                                            name="status" value="in progress" />
                                                    </form>
                                                @break

                                                @case('in progress')
                                                    <form action="{{ route('tasks.update', $task->id) }}" method="post">
                                                        @csrf
                                                        @method('PUT')
                                                        <div onclick="console.log(this.form)" class="relative cursor-pointer">
                                                            <input type="submit"
                                                                class="size-3 border text-transparent border-gray-600 flex rounded-md cursor-pointer"
                                                                name="status" value="done" />
                                                            <div
                                                                class="absolute bg-gold w-1/2 h-full top-0 right-0 border border-l-0 border-gray-600 rounded-r-md">
                                                            </div>
                                                        </div>
                                                    </form>
                                                @break

                                                @case('done')
                                                    <div
                                                        class="size-3 border text-transparent border-transparent bg-gold rounded-md">
                                                        <svg class="text-white fill-current" xmlns="http://www.w3.org/2000/svg"
                                                            viewBox="0 0 24 24">
                                                            <path
                                                                d="M9.86 18a1 1 0 0 1-.73-.32l-4.86-5.17a1 1 0 1 1 1.46-1.37l4.12 4.39 8.41-9.2a1 1 0 1 1 1.48 1.34l-9.14 10a1 1 0 0 1-.73.33z">
                                                                />
                                                        </svg>
                                                    </div>
                                                @break
                                            @endswitch

                                            <p
                                                class="m-0 leading-none {{ $task->status == 'done' ? 'line-through text-gold/75 decoration-gold/50' : 'text-gray-900 dark:text-gray-300' }}">
                                                {{ $task->title }}
                                            </p>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div
            class="bg-white h-full w-full dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900 flex-[100%] dark:text-gray-100">
            <div id="calendar" class="h-full"></div>

            @include('tasks.partials.update-modal')
        </div>
    </div>

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

    document.addEventListener("DOMContentLoaded", async function() {
        console.log("/tasks/all/{{ $team->id }}")
        const response = await axios.get("/tasks/all/{{ $team->id }}");
        const events = response.data?.events ?? [];
        const width = window.innerWidth;

        const myCalendar = document.getElementById("calendar");
        const calendar = new FullCalendar.Calendar(myCalendar, {
            initialView: width > 640 ? "dayGridMonth" : "timeGridDay",
            nowIndicator: true,
            headerToolbar: width > 640 ?
                null : {
                    left: "prev,next",
                    right: "today",
                },
            selectable: true,
            selectMirror: true,
            selectAllow: (info) => {
                let instant = new Date();
                return info.start >= instant;
            },
            select: (info) => {
                taskName.value = "";
                taskDescription.value = "";
                taskStart.value = formatDateTime(info.start);
                taskEnd.value = formatDateTime(info.end);

                addTaskModal.show();
            },

            events: events,
            eventClick: (info) => {
                updateTaskId.value = info.event.id;
                updateTaskName.value = info.event.title;
                updateTaskDescription.value = info.event.extendedProps.description;
                updateTaskStart.value = formatDateTime(info.event.start);
                updateTaskEnd.value = formatDateTime(info.event.end);

                updateTaskModal.show();
            },
        });
        calendar.render();
    });
</script>
{{-- @vite('resources/js/calender.js') --}}
