import './bootstrap';
import '@tailwindplus/elements';

import Swal from 'sweetalert2';

// ทำให้ Swal ใช้งานได้อิสระในไฟล์ Blade ทุกหน้า
window.Swal = Swal;