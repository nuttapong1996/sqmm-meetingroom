window.showLinkZoom = function (link, title, zoomId, passCode) {
    let displayLink = link && link.trim() !== "" ? link : "ไม่มีลิงก์ Zoom";
    let zoomID = zoomId && zoomId.trim() !== "" ? zoomId : "-";
    let zoomPass = passCode && passCode.trim() !== "" ? passCode : "-";

    Swal.fire({
        allowOutsideClick: false,
        confirmButtonColor: "#0B5CFF",
        html: ` 
                            <table class="table ">
                                <tr>
                                    <th class="w-40 text-right text-base">หัวข้อการประชุม:</th>
                                    <td class="text-base">${title.trim()}</td>
                                    </tr>
                                <tr>
                                    <th class="w-40 text-right text-base">Link Zoom:</th>
                                    <td><a href="${displayLink}" target="_blank" class="text-blue-600 line-clamp-3 underline break-all">${displayLink}</a></td>
                                    </tr>
                                <tr>
                                    <th class="w-40 text-right text-base">Link Zoom:</th>
                                    <td>${zoomID}
                                    </td>
                                    </tr>
                                <tr>
                                    <th class="w-40 text-right text-base">Link Zoom:</th>
                                    <td>${ zoomPass }</td>                                    
                                </tr>
                            </table>`,
        confirmButtonText: "OK",
    });
};

window.cancelMeeting = function (form) {
    Swal.fire({
        title: "ยืนยันการยกเลิก?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#ef4444",
        confirmButtonText: "ใช่, ยกเลิก!",
        cancelButtonText: "ไม่",
    }).then((result) => {
        if (result.isConfirmed) form.submit();
    });
};
