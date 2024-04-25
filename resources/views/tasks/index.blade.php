<x-app-layout>
    <x-slot name="header">
        <div class="relative">
            <h1 id="teamTask" class="text-gray-900 dark:text-gray-100 text-lg relative cursor-pointer">
                {{ $data['heading'] }}
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
                    <a class="px-8 py-2 hover:bg-gray-100 dark:hover:bg-gray-800 cursor-pointer text-[15px] text-nowrap"
                        href="/tasks">Personal</a>
                    @foreach (Auth::user()->teams as $team)
                        <a class="px-8 py-2 hover:bg-gray-100 dark:hover:bg-gray-800 cursor-pointer text-[15px] text-nowrap"
                            href="{{ route('tasks.show', $team->id) }}">{{ $team->name }}</a>
                    @endforeach
                </div>
            </dialog>
        </div>

        <div class="hidden sm:flex sm:ml-auto sm:mr-3">
            <button type="button"
                onclick="taskStart.value = formatDateTime(new Date());taskEnd.value = formatDateTime(new Date());addTaskModal.show()"
                class="flex justify-center items-center px-3 py-1.5 gap-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-bold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                <svg class="dark:text-gray-800 text-gray-200" width="16" height="16" fill="currentColor"
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                    <path
                        d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z" />
                </svg>
                Add Task
            </button>

            @include('tasks.partials.create-modal', $data)
        </div>
    </x-slot>

    <div
        class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-4 text-gray-900 dark:text-gray-100 flex flex-col lg:flex-row gap-4 w-full">
        @include('tasks.partials.update-modal')

        @foreach ($statuses as $status)
            <div class="flex-1 flex gap-2 flex-col">
                <div class="capitalize bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg px-6 py-4">
                    {{ $status }}
                </div>

                @forelse ($data['model']->tasks->where('status', $status) as $task)
                    <div onclick="updateTaskId.value = '{{ $task->id }}';updateTaskName.value = '{{ $task->title }}';updateTaskDescription.value = '{{ $task->description }}';updateTaskStart.value = '{{ $task->start }}';updateTaskEnd.value = '{{ $task->end }}';"
                        class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 flex flex-col gap-2">
                        <div class="flex gap-2">
                            @switch($task->status)
                                @case('to do')
                                    <form action="{{ route('tasks.update', $task->idd) }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <input type="submit"
                                            class="size-[18px] border-[1.5px] text-transparent cursor-pointer border-gray-600 rounded-md"
                                            name="status" value="in progress" />
                                    </form>
                                @break

                                @case('in progress')
                                    <form action="{{ route('tasks.update', $task->id) }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <div onclick="console.log(this.form)" class="relative cursor-pointer">
                                            <input type="submit"
                                                class="size-[18px] border-[1.5px] text-transparent border-gray-600 flex rounded-md cursor-pointer"
                                                name="status" value="done" />
                                            <div 
                                                class="absolute bg-gold w-1/2 h-full top-0 right-0 border-[1.5px] border-l-0 border-gray-600 rounded-r-md">
                                            </div>
                                        </div>
                                    </form>
                                @break

                                @case('done')
                                    <div
                                        class="size-[18px] border-[1.5px] text-transparent border-transparent bg-gold rounded-md">
                                        <svg class="text-white fill-current" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M9.86 18a1 1 0 0 1-.73-.32l-4.86-5.17a1 1 0 1 1 1.46-1.37l4.12 4.39 8.41-9.2a1 1 0 1 1 1.48 1.34l-9.14 10a1 1 0 0 1-.73.33z">
                                                />
                                        </svg>
                                    </div>
                                @break
                            @endswitch

                            <div class="flex flex-col gap-1">
                                <h5 class="leading-none font-medium">{{ $task->title }}</h5>
                                <p class="leading-none text-sm">{{ $task->description }}</p>
                            </div>
                        </div>

                        <span
                            class="self-end bg-gray-100 dark:bg-gray-900 py-2 px-3 rounded-lg text-sm leading-none flex items-center gap-2 before:size-[6px] before:bg-black before:dark:bg-white before:rounded-md">
                            {{ $task->priority }}
                        </span>
                    </div>
                    @empty
                        <div
                            class="bg-white dark:bg-gray-800 text-center overflow-hidden shadow-sm sm:rounded-lg px-6 py-4 flex flex-col gap-2">
                            No tasks available
                        </div>
                    @endforelse
                </div>
            @endforeach
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
    </script>
