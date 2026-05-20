<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Notifications\RealtimeNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotiController extends Controller
{
    // public function sendNoti($empcode)
    // {
    //     $user = Employee::find($empcode, 'code_emp')->get('name_thai_emp');
    //     $user = Employee::find($empcode, ['code_emp', 'name_thai_emp']);


    //     if (!$user) {
    //         return "ไม่พบผู้ใช้";
    //     }

    //     $message = "มีคิวงานใหม่ถูกมอบหมายให้คุณ ณ เวลา " . now()->format('H:i:s');

    //     $user->notify(new RealtimeNotification($message));


    //     return "ส่งแจ้งเตือนให้คุณ $user->name_thai_emp สำเร็จแล้ว!";
    // }


    public static function send($receivers, $message ,$url=null ,$meeting_id=null)
    {
        // เปลี่ยนมาใช้ Notification::send แทน ->notify()
        Notification::send($receivers, new RealtimeNotification($message , $url ,$meeting_id));
    }
}
