import './bootstrap';
import '@tailwindplus/elements';
import Alpine from 'alpinejs'
import Swal from 'sweetalert2';

// ทำให้ Swal ใช้งานได้อิสระในไฟล์ Blade ทุกหน้า
window.Swal = Swal;

window.Alpine = Alpine

Alpine.start()