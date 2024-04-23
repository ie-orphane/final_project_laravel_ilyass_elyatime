<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-4 text-gray-900 dark:text-gray-100 flex gap-4">
        @include('tasks.partials.update-modal')

        @foreach ($statuses as $status)
            <div class="flex-1 flex gap-2 flex-col">
                <div class="capitalize bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg px-6 py-4">
                    {{ $status }}
                </div>
                @foreach (Auth::user()->tasks($status) as $task)
                    <div onclick="updateTaskId.value = '{{ $task->id }}';updateTaskName.value = '{{ $task->title }}';updateTaskDescription.value = '{{ $task->description }}';updateTaskStart.value = '{{ $task->start }}';updateTaskEnd.value = '{{ $task->end }}';"
                        class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 flex flex-col">
                        <div class="flex gap-2">
                            @if ($task->status == 'to do')
                                <form action="{{ route('tasks.update', $task->id) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <input type="submit"
                                        class="size-[18px] border-[1.5px] text-transparent cursor-pointer border-gray-600 rounded-md"
                                        name="status" value="in progress" />
                                </form>
                            @endif

                            @if ($task->status == 'in progress')
                                <form action="{{ route('tasks.update', $task->id) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <input type="submit"
                                        class="size-[18px] border-[1.5px] text-transparent cursor-pointer border-gray-600 rounded-md"
                                        name="status" value="done" />
                                </form>
                            @endif

                            @if ($task->status == 'done')
                                <div class="size-[18px] border-[1.5px] text-transparent border-transparent bg-[#FFD700] rounded-md"></div>
                            @endif

                            <div>
                                <h5 class="leading-none font-medium">{{ $task->title }}</h5>
                                <p class="leading-none ">{{ $task->description }}</p>
                            </div>
                        </div>

                        <span
                            class="self-end bg-gray-100 dark:bg-gray-900 py-2 px-3 rounded-lg text-sm leading-none flex items-center gap-2 before:size-[6px] before:bg-black before:rounded-md">
                            {{ $task->priority }}
                        </span>
                    </div>
                @endforeach
            </div>
        @endforeach


        {{-- @if (Auth::user()->tasks)
                <table class="w-full text-center">
                    <thead class="w-full text-gray-900 dark:text-gray-400 text-lg">
                        <tr class="w-full flex py-2">
                            <th class="flex-1">Title</th>
                            <th class="flex-1">Start</th>
                            <th class="flex-1">End</th>
                            <th class="flex-1">Status</th>
                        </tr>
                    </thead>

                    <tbody class="w-full text-gray-900 dark:text-gray-100 text-lg">
                        @foreach (Auth::user()->tasks as $task)
                            <tr class="w-full py-3 flex justify-around border-t border-gray-400">
                                <td class="flex-1 flex items-center justify-center gap-4">{{ $task->title }}</td>
                                <td class="flex-1">{{ $task->start }}</td>
                                <td class="flex-1">{{ $task->end }}</td>
                                <td class="flex-1">
                                    <form action="{{ route('tasks.update', $task->id) }}" method="post">
                                        @csrf
                                        @method('PUT')

                                        <select onchange="this.form.submit()" name="status"
                                            class="border-none outline-none ring-0 shadow-none rounded {{ [
                                                'to do' => 'bg-red-700/25',
                                                'in progress' => 'bg-amber-700/25',
                                                'done' => 'bg-green-700/25',
                                            ][$task->status] }}">
                                            @foreach (['to do', 'in progress', 'done'] as $status)
                                                <option @selected($status == $task->status) class="dark:bg-gray-900"
                                                    value="{{ $status }}">{{ $status }}</option>
                                            @endforeach
                                        </select>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif --}}
    </div>
    </div>
</x-app-layout>
