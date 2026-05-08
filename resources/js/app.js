import "./bootstrap";
import "@tailwindplus/elements";
import Alpine from "alpinejs";
import Swal from "sweetalert2";

import { Calendar } from "@fullcalendar/core";
import dayGridPlugin from "@fullcalendar/daygrid";
import interactionPlugin from "@fullcalendar/interaction";

// ทำให้ Swal ใช้งานได้อิสระในไฟล์ Blade ทุกหน้า
window.Swal = Swal;

window.Alpine = Alpine;

Alpine.start();

window.setupCalendar = function () {
    const calendarEl = document.getElementById("calendar");
    if (calendarEl) {
        const calendar = new Calendar(calendarEl, {
            plugins: [dayGridPlugin, interactionPlugin],
            initialView: "dayGridMonth",
            editable: true,
            // ตัวอย่างการดึงข้อมูลจาก Laravel API
            events: "/api/meetings",
            dateClick: function (info) {
                alert("วันที่คุณคลิกคือ: " + info.dateStr);
            },
        });
        calendar.render();
    }
};
