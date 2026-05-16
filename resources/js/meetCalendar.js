import { Calendar, formatDate } from "@fullcalendar/core";
import dayGridPlugin from "@fullcalendar/daygrid";
// import interactionPlugin from "@fullcalendar/interaction";
import listPlugin from "@fullcalendar/list";

window.setupCalendar = function () {
    const calendarEl = document.getElementById("meetCalendar");

    function isMobile() {
        return window.innerWidth < 768;
    }

    let eventsUrl = calendarEl.dataset.url;

    if (calendarEl) {
        const calendar = new Calendar(calendarEl, {
            plugins: [dayGridPlugin, listPlugin],
            initialView: isMobile() ? "listMonth" : "dayGridMonth",
            height: isMobile() ? "auto" : 800,
            headerToolbar: {
                start: "prev,today,next",
                center: "title",
                end: "dayGridMonth,listMonth",
            },
            views: {
                dayGridMonth: {
                    displayEventTime: false,
                },
                listMonth: {
                    locale: "th",
                    eventTimeFormat: {
                        hour: "numeric",
                        minute: "2-digit",
                        meridiem: false,
                    },
                },
            },
            locale: "th",
            editable: false,
            events: eventsUrl,
            eventDisplay: "block",

            eventClick: function (info) {
                info.jsEvent.preventDefault();
                let title = info.event.title;
                let subtitle = info.event.extendedProps.subtitle;
                let roomName = info.event.extendedProps.room_name;
                let owner = info.event.extendedProps.emp;
                let dept = info.event.extendedProps.dept;
                let start = new Intl.DateTimeFormat("th-TH", {
                    dateStyle: "short",
                    timeStyle: "short",
                }).format(info.event.start);
                let end = new Intl.DateTimeFormat("th-TH", {
                    dateStyle: "short",
                    timeStyle: "short",
                }).format(info.event.end);
                let zoomUse =
                    info.event.extendedProps.zoom == 1 ? "ใช้" : "ไม่ใช้";
                let audioUse =
                    info.event.extendedProps.audio == 1 ? "ใช้" : "ไม่ใช้";
                let other =
                    info.event.extendedProps.other == null
                        ? "-"
                        : info.event.extendedProps.other;

                Swal.fire({
                    title: "รายละเอียด",
                    allowOutsideClick: false,
                    confirmButtonColor: "#2F2982",
                    html:
                        `<table class="table table-auto">
                            <tr >
                                <th>หัวข้อ</th>
                                <td>` +
                        subtitle +
                        `</td>
                            </tr>
                            <tr>
                                <th>ห้องประชุม</th>
                                <td>` +
                        roomName +
                        `</td>
                            </tr>
                            <tr>
                                <th>ผู้จอง</th>
                                <td>` +
                        owner +
                        `</td>
                            </tr>
                            <tr>
                                <th>แผนก</th>
                                <td>` +
                        dept +
                        `</td>
                            </tr>
                            <tr>
                                <th>เริ่ม</th>
                                <td>` +
                        start +
                        ` น.</td>
                            </tr>
                            <tr>
                                <th>สิ้นสุด</th>
                                <td>` +
                        end +
                        ` น.</td>
                            </tr>
                            <tr>
                                <th>Zoom</th>
                                <td>` +
                        zoomUse +
                        `</td>
                            </tr>
                            <tr>
                                <th>เครื่องเสียง</th>
                                <td>` +
                        audioUse +
                        `</td>
                            </tr>
                            <tr>
                                <th>อื่นๆ</th>
                                <td>` +
                        other +
                        `</td>
                            </tr>
                        </table>`,
                });
            },
        });
        calendar.render();
    }
};

document.addEventListener("DOMContentLoaded", function () {
    window.setupCalendar();
});

// Card Room Status
document.addEventListener("DOMContentLoaded", function () {
    const container = document.getElementById("room-status-container");
    let eventsUrl = container.dataset.status;
    // ฟังก์ชันสำหรับไปดึงข้อมูลและวาด Card
    function fetchAndRenderRoomStatus() {
        fetch(eventsUrl)
            .then((response) => response.json())
            .then((data) => {
                // เคลียร์ข้อมูลเก่าออกก่อน
                container.innerHTML = "";

                // วนลูปสร้าง Card ตามจำนวนห้อง
                data.forEach((room) => {
                    // กำหนดสีและไอคอนตามสถานะ
                    let isFree = room.status === "free";
                    let roomColor = room.color;
                    let bgColor = isFree
                        ? "bg-green-100 border-green-500"
                        : "bg-red-100 border-red-500";
                    let textColor = isFree ? "text-green-700" : "text-red-700";
                    let statusText = isFree
                        ? "🟢 ว่างพร้อมใช้งาน"
                        : "🔴 กำลังใช้งาน";
                    let meetingDetail = isFree
                        ? "ไม่มีการประชุม ณ ขณะนี้"
                        : `หัวข้อ: ${room.meeting_title}`;

                    // วาด HTML ของ Card ด้วย Tailwind
                    let cardHtml = `
                            <div class="border-l-4 rounded-lg shadow-sm p-5 bg-white ${bgColor} transition-all duration-300">
                                <div class="flex justify-between items-center mb-2">
                                    <h3 class="badge text-lg text-gray-50 font-bold p-3" style="background:${roomColor};">${room.name}</h3>
                                    <span class="text-sm font-semibold ${textColor}">${statusText}</span>
                                </div>
                                <p class="text-sm text-gray-600">${meetingDetail}</p>
                            </div>
                        `;

                    // นำ Card ไปใส่ใน Container
                    container.innerHTML += cardHtml;
                });
            })
            .catch((error) =>
                console.error("Error fetching room status:", error),
            );
    }

    // 1. เรียกใช้งานทันทีตอนเปิดหน้าเว็บครั้งแรก
    fetchAndRenderRoomStatus();

    // 2. สั่งให้ทำงานซ้ำทุกๆ 10 วินาที (10000 มิลลิวินาที)
    setInterval(fetchAndRenderRoomStatus, 10000);
});
