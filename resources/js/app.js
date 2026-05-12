import "./bootstrap";
import "@tailwindplus/elements";
import Alpine from "alpinejs";
import Swal from "sweetalert2";

import flatpickr from "flatpickr";
import "flatpickr/dist/flatpickr.min.css";

// นำเข้าภาษาไทย
import { Thai } from "flatpickr/dist/l10n/th.js";

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

document.addEventListener("DOMContentLoaded", function () {
    // เปลี่ยนมาใช้ class .date-picker เพื่อให้ครอบคลุมทั้งช่องเริ่มและสิ้นสุด
    flatpickr(".date-picker", {
        locale: Thai, // ใช้ตัวแปร Thai ที่ import มา
        altInput: true,
        enableTime: true,
        dateFormat: "Y-m-d H:i",
        altFormat: "j F Y H:i",
        onChange: function (selectedDates, dateStr, instance) {
            // 1. ลบคลาสแดงออกจาก Input ตัวจริง (ที่ถูกซ่อนอยู่)
            instance.element.classList.remove("input-error");

            // 2. ลบคลาสแดงออกจาก Input ตัวที่แสดงผลหน้าเว็บ (ที่ altInput สร้างขึ้นมา)
            if (instance.altInput) {
                instance.altInput.classList.remove("input-error");
            }

            // 3. ลบข้อความแจ้งเตือน Error ด้านล่าง
            const errorMsg = document.getElementById(
                "error-" + instance.element.name,
            );
            if (errorMsg) {
                errorMsg.remove();
            }

            instance.element.classList.add("input-success");
            if (instance.altInput) {
                instance.altInput.classList.add("input-success");
            }
        },
    });
});
