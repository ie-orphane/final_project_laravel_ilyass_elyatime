import "./bootstrap";
import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

window.formatDateTime = function (datetime) {
    let year = String(datetime.getFullYear()).padStart(4, 0);
    let month = String(datetime.getMonth() + 1).padStart(2, 0);
    let day = String(datetime.getDate()).padStart(2, 0);

    let hour = String(datetime.getHours()).padStart(2, 0);
    let min = String(datetime.getMinutes()).padStart(2, 0);
    let sec = String(datetime.getSeconds()).padStart(2, 0);

    return `${year}-${month}-${day} ${hour}:${min}:${sec}`;
};
