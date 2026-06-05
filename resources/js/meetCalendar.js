import { Calendar, formatDate } from "@fullcalendar/core";
import dayGridPlugin from "@fullcalendar/daygrid";
import listPlugin from "@fullcalendar/list";

window.setupCalendar = function () {
    const calendarEl = document.getElementById("meetCalendar");

    function isMobile() {
        return window.innerWidth < 768;
    }

    if (calendarEl) {
        let eventsUrl = calendarEl.dataset.url;
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
                    eventTimeFormat: {
                        hour: "numeric",
                        minute: "2-digit",
                        meridiem: false,
                    },
                },
            },
            buttonText: {
                today: "วันนี้", // Overrides the "today" button
                month: "เดือน",
                list: "รายการ", // Overrides the "month" view button
            },
            locale: "th",
            themeSystem: "cosmo",
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
            eventContent: function (arg) {
                let zoomUse = arg.event.extendedProps.zoom;

                let containerEl = document.createElement("div");
                let imgEl = document.createElement("img");
                let titleEl = document.createElement("span");

                if (zoomUse == 1) {
                    // 1. สร้างกล่องหลัก (Container) เพื่อจับมัดรวมกัน
                    containerEl.style.display = "flex"; // ใช้ Flexbox จัดเรียง
                    containerEl.style.alignItems = "center"; // ให้อยู่กึ่งกลางแนวตั้งเสมอ
                    containerEl.style.whiteSpace = "nowrap"; // **บังคับไม่ให้ตัดขึ้นบรรทัดใหม่**
                    containerEl.style.overflow = "hidden"; // ซ่อนส่วนที่ล้น

                    // 2. สร้าง Tag รูปภาพ (img)

                    imgEl.src = "/images/zoom_icon.png";
                    imgEl.style.width = "14px";
                    imgEl.style.height = "14px";
                    imgEl.style.marginRight = "6px";
                    imgEl.style.flexShrink = "0"; // **ป้องกันไม่ให้รูปโดนบีบจนเบี้ยว**
                }
                // 3. สร้าง Tag ข้อความ Title
                titleEl.innerText = arg.event.title;
                titleEl.style.overflow = "hidden";
                titleEl.style.textOverflow = "ellipsis"; // ถ้าข้อยาวเกิน ให้ใส่ ... ต่อท้าย
                containerEl.appendChild(imgEl);
                containerEl.appendChild(titleEl);
                return { domNodes: [containerEl] };
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
    if (container) {
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
                        let textColor = isFree
                            ? "text-green-700"
                            : "text-red-700";
                        let statusText = isFree
                            ? "🟢 ว่างพร้อมใช้งาน"
                            : "🔴 กำลังใช้งาน";
                        let meetingDetail = isFree
                            ? "ไม่มีการประชุม ณ ขณะนี้"
                            : `หัวข้อ: ${room.meeting_title}`;
                        let zoom = room.zoom_use == 1 ? "block" : "none";
                        let audio = room.audio_system == 1 ? "block" : "none";
                        // วาด HTML ของ Card ด้วย Tailwind
                        let cardHtml = `
                        <a href="/room/status/${room.id}" class="block cursor-pointer hover:shadow-md transition-all duration-300">
                            <div class="border-l-4 rounded-lg shadow-sm p-5 bg-white ${bgColor} transition-all duration-300">
                                <div class="flex justify-between items-center mb-2">
                                    <h3 class="badge text-lg text-gray-50 font-bold p-3" style="background:${roomColor};">${room.name}</h3>
                                    <span class="text-sm font-semibold ${textColor}">${statusText}</span>
                                </div>

                                 <div class="flex flex-row items-center mb-5">
                                    <svg class="h-5 w-5 mr-2" style="display:${zoom}"  viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M2 11.6C2 8.23969 2 6.55953 2.65396 5.27606C3.2292 4.14708 4.14708 3.2292 5.27606 2.65396C6.55953 2 8.23969 2 11.6 2H20.4C23.7603 2 25.4405 2 26.7239 2.65396C27.8529 3.2292 28.7708 4.14708 29.346 5.27606C30 6.55953 30 8.23969 30 11.6V20.4C30 23.7603 30 25.4405 29.346 26.7239C28.7708 27.8529 27.8529 28.7708 26.7239 29.346C25.4405 30 23.7603 30 20.4 30H11.6C8.23969 30 6.55953 30 5.27606 29.346C4.14708 28.7708 3.2292 27.8529 2.65396 26.7239C2 25.4405 2 23.7603 2 20.4V11.6Z" fill="#4087FC"></path> <path d="M8.26667 10C7.56711 10 7 10.6396 7 11.4286V18.3571C7 20.369 8.44612 22 10.23 22L17.7333 21.9286C18.4329 21.9286 19 21.289 19 20.5V13.5C19 11.4881 17.2839 10 15.5 10L8.26667 10Z" fill="white"></path> <path d="M20.7122 12.7276C20.2596 13.1752 20 13.8211 20 14.5V17.3993C20 18.0782 20.2596 18.7242 20.7122 19.1717L23.5288 21.6525C24.1019 22.2191 25 21.7601 25 20.9005V11.1352C25 10.2755 24.1019 9.81654 23.5288 10.3832L20.7122 12.7276Z" fill="white"></path> </g></svg>
                                    <h5 class="text-sm text-gray-600" >${meetingDetail}</h5>
                                </div>
                            </div>
                        </a>
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
    }
});
