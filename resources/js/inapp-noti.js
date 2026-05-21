document.addEventListener("DOMContentLoaded", () => {
    const csrfMeta = document.querySelector('meta[name="csrf-token"]');
    const csrfToken = csrfMeta ? csrfMeta.getAttribute("content") : "";
    const userIdMeta = document.querySelector('meta[name="user-id"]');
    const userId = userIdMeta ? userIdMeta.getAttribute("content") : null;

    // Function อ่านแล้ว
    window.markAsRead = function (id) {
        const notiElement = document.getElementById(`noti-${id}`);
        if (!notiElement) return;
        fetch(`/notifications/${id}/read`, {
            method: "PATCH",
            headers: { "X-CSRF-TOKEN": csrfToken, Accept: "application/json" },
        })
            .then((res) => res.json())
            .then((data) => {
                if (data.success) {
                    notiElement.classList.remove("bg-blue-50", "font-semibold");
                    notiElement.classList.add("bg-white", "text-gray-500");
                    updateBadgeCount(-1);
                }
            });
    };

    // Function อ่านทั้งหมด
    window.markAllAsRead = function () {
        fetch(`/notifications/read-all`, {
            method: "PATCH",
            headers: { "X-CSRF-TOKEN": csrfToken, Accept: "application/json" },
        })
            .then((res) => res.json())
            .then((data) => {
                if (data.success) {
                    document.querySelectorAll(".bg-blue-50").forEach((el) => {
                        el.classList.remove("bg-blue-50", "font-semibold");
                        el.classList.add("bg-white", "text-gray-500");
                    });

                    const btn = document.getElementById("btn-mark-all");
                    if (btn) btn.style.display = "none";

                    updateBadgeCount(0, true);
                }
            });
    };

    // Function ลบแจ้งเตือน
    window.deleteNotification = function (id) {
        fetch(`/notifications/${id}`, {
            method: "DELETE",
            headers: { "X-CSRF-TOKEN": csrfToken, Accept: "application/json" },
        })
            .then((res) => res.json())
            .then((data) => {
                if (data.success) {
                    const notiElement = document.getElementById(`noti-${id}`);

                    updateBadgeCount(-1);

                    notiElement.style.transition = "opacity 0.3s";
                    notiElement.style.opacity = "0";
                    setTimeout(() => {
                        notiElement.remove();
                        const list =
                            document.getElementById("notification-list");
                        if (list && list.children.length === 0) {
                            list.innerHTML =
                                '<li id="no-notification" class="py-4 text-center text-gray-500 bg-gray-50 rounded">ไม่มีการแจ้งเตือนใหม่</li>';
                        }
                    }, 300);
                }
            });
    };

    function updateBadgeCount(change, setZero = false) {
        const badge = document.getElementById("notification-badge");
        if (!badge) return;

        let currentCount = parseInt(badge.innerText) || 0;

        if (setZero) {
            currentCount = 0;
        } else {
            currentCount += change;
        }

        if (currentCount > 0) {
            badge.innerText = currentCount;
            badge.classList.remove("hidden");

            if (change > 0) {
                badge.classList.add("animate-bounce");
                setTimeout(
                    () => badge.classList.remove("animate-bounce"),
                    1000,
                );
            }
        } else {
            badge.innerText = 0;
            badge.classList.add("hidden");
        }
    }

    // Function รับการแจ้งเตือน
    if (userId && window.Echo) {
        window.Echo.private(`App.Models.Employee.${userId}`).notification(
            (notification) => {
                updateBadgeCount(1);

                // ตัวอย่างการดึงข้อความมาใช้ (อ้างอิงจาก Error ก่อนหน้าของคุณที่มีคำว่า message กับ url)
                const message = notification.message;
                const link = notification.url;

                // ตัวอย่าง: แจ้งเตือนผ่าน Alert (หรือจะเปลี่ยนไปใช้ SweetAlert2, Toastr ก็ได้ครับ)
                // alert(`แจ้งเตือนใหม่: ${message}`);
                const li = document.createElement("li");
                li.innerHTML = `
                    <a href="${link}" class="flex flex-col p-3 hover:bg-gray-100 border-b border-gray-100 transition-colors duration-200">
                        <span class="text-sm font-medium text-gray-800">${message}</span>
                        <span class="text-xs text-gray-500 mt-1">เมื่อสักครู่</span>
                    </a>
                `;

                const notificationList =
                    document.getElementById("notification-list");
                if (notificationList) {
                    // ลบข้อความ "ไม่มีการแจ้งเตือน" ออกถ้ามี
                    const emptyMsg =
                        notificationList.querySelector(".text-center");
                    if (emptyMsg && emptyMsg.innerText.includes("ไม่มี")) {
                        notificationList.innerHTML = "";
                    }
                    // เพิ่มรายการใหม่ไว้บนสุด
                    notificationList.prepend(li);
                }

                // แสดง Toast แจ้งเตือน
                // if (window.Swal) {
                //     const Toast = Swal.mixin({
                //         toast: true,
                //         position: 'top-end',
                //         showConfirmButton: false,
                //         timer: 3000,
                //         timerProgressBar: true,
                //     });
                //     Toast.fire({
                //         icon: 'info',
                //         title: message
                //     });
                // }
            },
        );
    }
});
