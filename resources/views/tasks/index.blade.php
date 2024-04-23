<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-4 text-gray-900 dark:text-gray-100 flex flex-col lg:flex-row gap-4 w-full">
        @include('tasks.partials.update-modal')

        @foreach ($statuses as $status)
            <div class="flex-1 flex gap-2 flex-col">
                <div class="capitalize bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg px-6 py-4">
                    {{ $status }}
                </div>

                @forelse (Auth::user()->tasks($status) as $task)
                    <div onclick="updateTaskId.value = '{{ $task->id }}';updateTaskName.value = '{{ $task->title }}';updateTaskDescription.value = '{{ $task->description }}';updateTaskStart.value = '{{ $task->start }}';updateTaskEnd.value = '{{ $task->end }}';"
                        class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 flex flex-col gap-2">
                        <div class="flex gap-2">
                            @switch($task->status)
                                @case('to do')
                                    <form action="{{ route('tasks.update', $task->id) }}" method="post">
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
                                        <div class="relative">
                                            <input type="submit"
                                                class="size-[18px] border-[1.5px] text-transparent cursor-pointer border-gray-600 flex rounded-md relative after:absolute after:bg-gold after:w-1/2 after:size-4 after:top-0 after:left-0"
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
