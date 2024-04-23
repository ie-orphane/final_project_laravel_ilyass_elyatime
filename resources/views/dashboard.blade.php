<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-4 h-full w-full">
        <div
            class="bg-white h-full w-full dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900 dark:text-gray-100">
            <div id="calendar" class="h-full"></div>

            @include('tasks.partials.create-modal')
            @include('tasks.partials.update-modal')

            <script>
                document.addEventListener('DOMContentLoaded', async function() {
                    const response = await axios.get('/calander')
                    const events = response.data?.events ?? []
                    const width = window.innerWidth

                    const myCalendar = document.getElementById('calendar');
                    const calendar = new FullCalendar.Calendar(myCalendar, {
                        initialView: width > 640 ? "timeGridWeek" : "timeGridDay",
                        nowIndicator: true,
                        headerToolbar: width > 640 ? null : {
                            left: "prev,next",
                            right: "today",
                        },
                        // headerToolbar: {
                        //     left: width > 640 ? "dayGridMonth,timeGridWeek,timeGridDay" : "prev,next",
                        //     center: width > 700 ? "title" : "",
                        //     right: width > 640 ? "today,prev,next" : "today",
                        // },
                        selectable: true,
                        selectMirror: true,
                        selectAllow: (info) => {
                            let instant = new Date()
                            return info.start >= instant
                        },
                        select: (info) => {
                            taskName.value = ""
                            taskDescription.value = ""
                            taskStart.value = formatDateTime(info.start)
                            taskEnd.value = formatDateTime(info.end)

                            addTaskModal.show()
                        },

                        events: events,
                        eventClick: (info) => {
                            updateTaskId.value = info.event.id
                            updateTaskName.value = info.event.title
                            updateTaskDescription.value = info.event.extendedProps.description
                            updateTaskStart.value = formatDateTime(info.event.start)
                            updateTaskEnd.value = formatDateTime(info.event.end)

                            updateTaskModal.show()
                        },
                    });
                    calendar.render();
                });
            </script>
        </div>
    </div>
</x-app-layout>
