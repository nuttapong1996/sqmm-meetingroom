import "./bootstrap";
import "./meetCalendar";
import "./date-picker";
import "./inapp-noti";
import "./button";
import "./room";
import "@tailwindplus/elements";
import Alpine from "alpinejs";
import Swal from "sweetalert2";
import flatpickr from "flatpickr";
import "flatpickr/dist/flatpickr.min.css";

// ทำให้ Swal ใช้งานได้อิสระในไฟล์ Blade ทุกหน้า
window.Swal = Swal;

window.Alpine = Alpine;

Alpine.start();
