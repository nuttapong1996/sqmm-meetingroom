<?php
use Illuminate\Support\Facades\Schedule;
use Illuminate\Support\Facades\DB;

Schedule::call(function () {
    // ลบ notification ที่ถูกอ่านแล้ว (read_at ไม่เป็น null)
    // หรือ เก่ากว่า 1 เดือน
    DB::table('notifications')
        ->whereNotNull('read_at')
        ->orWhere('created_at', '<', now()->subMonth())
        ->delete();
})->timezone('Asia/Bangkok')
->dailyAt('00:00');
