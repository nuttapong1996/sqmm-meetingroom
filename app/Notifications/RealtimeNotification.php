<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;

class RealtimeNotification extends Notification
{
    // use Queueable;


    public function __construct(
        public string $message,
        public ?string $url = null,
        public ?string $meeting_id,
    ) {}

    // กำหนดช่องทางในการส่ง: ลง Database และ Broadcast ผ่าน WebSocket
    public function via(object $notifiable): array
    {
        return ['database', 'broadcast'];
    }

    // ข้อมูลที่จะลง Database
    public function toArray(object $notifiable): array
    {
        return [
            'message' => $this->message,
            'url' => $this->url ?? '#',
            'meeting_id' => $this->meeting_id,
        ];
    }

    // ข้อมูลที่จะส่งออกไปหา Laravel Echo แบบ Real-time
    public function toBroadcast(object $notifiable): BroadcastMessage
    {
        return new BroadcastMessage([
            'id' => $this->id,
            'message' => $this->message,
            'url' => $this->url ?? '#',
            'created_at' => now()->diffForHumans(),
        ]);
    }
}
