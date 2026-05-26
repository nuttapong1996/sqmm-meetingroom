<?php

use App\Http\Controllers\AdminDashboard;
use App\Http\Controllers\CheckEmployee;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::middleware('guest')->group(function () {
    Route::get('login', [CheckEmployee::class, 'index'])->name('login');
    Route::post('login', [CheckEmployee::class, 'login'])->name('check-emp');
});

Route::middleware('auth')->group(function () {

    Route::get('logout', [CheckEmployee::class, 'logout'])->name('logout');

    Route::get('meeting/create', [MeetingController::class, 'create'])->name('meeting.create');
    Route::post('meeting/store', [MeetingController::class, 'store'])->name('meeting.store');
    Route::get('/meeting/{id}', [MeetingController::class, 'show'])->name('meeting.show');
    Route::put('/meeting/cancel/{id}', [MeetingController::class, 'cancelMeeting'])->name('meeting.cancel');
    Route::get('/personal/meetings', [MeetingController::class, 'personalMeeting'])->name('personal.events');

    Route::patch('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
    Route::patch('/notifications/read-all', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllAsRead');
    Route::delete('/notifications/{id}', [NotificationController::class, 'destroy'])->name('notifications.destroy');
});
Route::middleware('admin')->group(function () {
    Route::get('admin', [AdminDashboard::class, 'index'])->name('admin');

    Route::get('admin/rooms', [RoomController::class, 'index'])->name('room.index');
    Route::get('admin/room/create', [RoomController::class, 'create'])->name('room.create');
    Route::post('admin/room/store', [RoomController::class, 'store'])->name('room.store');
    Route::get('admin/room/{room}/edit', [RoomController::class, 'edit'])->name('room.edit');
    Route::put('admin/room/{room}/update', [RoomController::class, 'update'])->name('room.update');
    Route::delete('admin/room/{room}/remove/', [RoomController::class, 'destroy'])->name('room.remove');

    Route::get('admin/meeting/{id}', [MeetingController::class, 'adminShow'])->name('admin.meeting.show');
    Route::get('admin/meetings', [MeetingController::class, 'adminMeetingManage'])->name('admin.meeting.list');
    Route::put('admin/meetings/cancel/{id}', [MeetingController::class, 'adminCancelMeeting'])->name('admin.meeting.cancel');

    Route::get('admin/zoom/list', [MeetingController::class, 'zoomList'])->name('zoom.list');
    Route::get('admin/zoom/create/{id}', [MeetingController::class, 'zoomCreate'])->name('admin.zoom.create');
    Route::put('admin/zoom/store/{id}', [MeetingController::class, 'zoomStore'])->name('admin.zoom.store');
});
