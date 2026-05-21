<?php

namespace App\Http\Controllers;

use App\Notifications\RealtimeNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;


class NotificationController extends Controller
{
    public static function send($receivers, $message, $url = null, $meeting_id = null , $meeting_title = null)
    {
        // เปลี่ยนมาใช้ Notification::send แทน ->notify()
        Notification::send($receivers, new RealtimeNotification($message, $url, $meeting_id , $meeting_title));
    }


    public function markAsRead($id)
    {

        $notification = Auth::user()->notifications()->where('id', $id)->first();

        if ($notification && $notification->unread()) {
            $notification->markAsRead();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 400);
    }


    public function markAllAsRead()
    {
        Auth::user()->unreadNotifications->markAsRead();
        return response()->json(['success' => true]);
    }

    // ลบการแจ้งเตือน
    public function destroy($id)
    {
        $notification = Auth::user()->notifications()->where('id', $id)->first();

        if ($notification) {
            $notification->delete();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 404);
    }
}
