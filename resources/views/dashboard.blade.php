<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-4 h-screen">
        <div
            class="bg-white dark:bg-gray-800 h-full overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900 dark:text-gray-100">
            <div id="calendar"></div>

            @include('tasks.partials.create-modal')
            @include('tasks.partials.update-modal')

            <script>
                document.addEventListener('DOMContentLoaded', async function() {
                    const response = await axios.get('/calander')
                    const events = response.data?.events ?? []

                    const myCalendar = document.getElementById('calendar');
                    const calendar = new FullCalendar.Calendar(myCalendar, {
                        initialView: "timeGridWeek",
                        nowIndicator: true,
                        headerToolbar: {
                            left: 'dayGridMonth,timeGridWeek,timeGridDay',
                            center: 'title',
                        },

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

                    function formatDateTime(datetime) {
                        let year = String(datetime.getFullYear()).padStart(4, 0)
                        let month = String(datetime.getMonth() + 1).padStart(2, 0)
                        let day = String(datetime.getDate()).padStart(2, 0)

                        let hour = String(datetime.getHours()).padStart(2, 0)
                        let min = String(datetime.getMinutes()).padStart(2, 0)
                        let sec = String(datetime.getSeconds()).padStart(2, 0)

                        return `${year}-${month}-${day} ${hour}:${min}:${sec}`
                    }
                });
            </script>
        </div>
    </div>
</x-app-layout>
