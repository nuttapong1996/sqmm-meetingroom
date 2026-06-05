document.addEventListener("DOMContentLoaded", function () {
    const Rcontain = document.getElementById("room_container");
    if (Rcontain) {
        let eventURL = Rcontain.dataset.status;
        let assetURL = Rcontain.getAttribute("data-asset");
        const roomStatusTx = document.getElementById("roomStatus");
        const iconStatus = document.getElementById("icon");
        const currentTitle = document.getElementById("currentTitle");
        const currentStartTime = document.getElementById("currentStartTime");
        const currentEndTime = document.getElementById("currentEndTime");
        const nextTitle = document.getElementById("nextTitle");
        const nextTimeTx = document.getElementById("nextTime");
        const currentDiv = document.getElementById("currentDiv");
        const curZoomIconHolder = document.getElementById("curZoomIconHolder");
        const nextZoomIconHolder = document.getElementById("nextZoomIconHolder");



        const thaiformat = new Intl.DateTimeFormat("th-TH", {
            dateStyle: "medium", // วันในสัปดาห์, วันที่, เดือน, พ.ศ.
            timeStyle: "short", // เวลา (ชั่วโมง:นาที)
        });

        function fetchAndRenderRoomStatus() {
            fetch(eventURL)
                .then((response) => response.json())
                .then((data) => {
                    roomStatusTx.innerHTML = "";
                    let isFree = data.room.status === "free";
                    let roomColor = data.room.color;
                    let icon = isFree
                        ? "images/available.svg"
                        : "images/unavailable.svg";
                    let curZoom = data.current.zoom == 1 ? "block" : "none";
                    let nextZoom = data.next.zoom == 1 ? "block" : "none";


                    let statusBadge = isFree
                        ? "badge border border-green-700 bg-green-100 text-center text-2xl text-green-800 font-bold mx-5 p-4"
                        : "badge border border-red-700 bg-red-100 text-center  text-2xl text-red-800 font-bold mx-5 p-4";
                    let currentBadge = isFree
                        ? "badge border border-gray-700 bg-gray-100 text-center text-gray-800 font-bold my-3  p-4"
                        : "badge border border-red-700 bg-red-100 text-center text-red-800 font-bold my-3 p-4";
                    let statusText = isFree ? "ว่าง" : "ไม่ว่าง";
                    let curStart = new Date(data.current.start);
                    let curEnd = new Date(data.current.end);
                    let nextStart =
                        data.next.title === null
                            ? "-"
                            : new Date(data.next.start);
                    let nextEnd =
                        data.next.title === null
                            ? "-"
                            : new Date(data.next.end);

                    let curStartTime = isFree
                        ? "-"
                        : "<b>เริ่ม : </b>" +
                          thaiformat.format(curStart) +
                          " น.";
                    let curEndTime = isFree
                        ? "-"
                        : "<b>สิ้นสุด : </b>" +
                          thaiformat.format(curEnd) +
                          " น.";

                    let nextTime = data.next.title === "-" ? "-" : thaiformat.format(nextStart) + " น. - " +  thaiformat.format(nextEnd) + " น.";

                    curZoomIconHolder.style.display = curZoom;
                    nextZoomIconHolder.style.display = nextZoom;
                    iconStatus.src = assetURL + icon;
                    roomStatusTx.className = statusBadge;
                    roomStatusTx.textContent = statusText;
                    currentTitle.textContent = isFree
                        ? "ไม่มีการประชุม"
                        : data.current.title;

                    currentStartTime.innerHTML = curStartTime;
                    currentEndTime.innerHTML = curEndTime;
                    currentDiv.textContent = isFree
                        ? "ประชุมปัจจุบัน"
                        : "กำลังประชุม";
                    currentDiv.className = currentBadge;
                    nextTitle.textContent =
                        data.next.title === null
                            ? "ไม่มีการประชุม"
                            : data.next.title;
                    nextTimeTx.textContent = nextTime;
                })
                .catch((error) =>
                    console.error("Error fetching room status:", error),
                );
        }
        fetchAndRenderRoomStatus();
        setInterval(fetchAndRenderRoomStatus, 10000);
    }
});
