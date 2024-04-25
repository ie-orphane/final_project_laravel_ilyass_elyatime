document.addEventListener("DOMContentLoaded", async function () {
    const response = await axios.get("/tasks/all");
    const events = response.data?.events ?? [];
    const width = window.innerWidth;

    const myCalendar = document.getElementById("calendar");
    const calendar = new FullCalendar.Calendar(myCalendar, {
        initialView: width > 640 ? "timeGridWeek" : "timeGridDay",
        nowIndicator: true,
        headerToolbar:
            width > 640
                ? null
                : {
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
