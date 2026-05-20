<?php

use App\Http\Controllers\AdminDashboard;
use App\Http\Controllers\CheckEmployee;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\NotiController;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('login', [CheckEmployee::class, 'index'])->middleware('guest')->name('login');
Route::post('login', [CheckEmployee::class, 'login'])->name('check-emp');
Route::get('logout', [CheckEmployee::class, 'logout'])->name('logout');

Route::get('book',[MeetingController::class , 'create'])->middleware('auth')->name('book');
Route::post('book/store',[MeetingController::class , 'store'])->middleware('auth')->name('book.store');

Route::get('admin', [AdminDashboard::class , 'index'])->middleware('admin')->name('admin');
Route::get('admin/meeting/list', [MeetingController::class, 'adminMeetingManage'])->middleware('admin')->name('admin.meeting.list');
Route::get('admin/zoom/list', [MeetingController::class, 'zoomList'])->middleware('admin')->name('admin.zoom.list');
Route::get('admin/zoom/create/{id}', [MeetingController::class, 'zoomCreate'])->middleware('admin')->name('admin.zoom.create');
Route::put('admin/zoom/store/{id}', [MeetingController::class, 'zoomStore'])->middleware('admin')->name('admin.zoom.store');
Route::put('admin/meetings/cancel/{id}', [MeetingController::class, 'adminCancelMeeting'])->middleware('admin')->name('admin.meeting.cancel');
Route::get('admin/rooms', [RoomController::class, 'index'])->middleware('admin')->name('room.index');
Route::get('admin/room/create',[RoomController::class , 'create'])->middleware('admin')->name('room.create');
Route::post('admin/room/store',[RoomController::class,'store'])->middleware('admin')->name('room.store');
Route::get('admin/room/{room}/edit',[RoomController::class,'edit'])->middleware('admin')->name('room.edit');
Route::put('admin/room/{room}/update',[RoomController::class,'update'])->middleware('admin')->name('room.update');
Route::delete('admin/room/{room}/remove/',[RoomController::class , 'destroy'])->middleware('admin')->name('room.remove');

Route::get('/personal/meetings', [MeetingController::class, 'personalMeeting'])->middleware('auth')->name('personal.events');
Route::put('/meetings/cancel/{id}', [MeetingController::class, 'cancelMeeting'])->middleware('auth')->name('meeting.cancel');

Route::get('/send-noti/{empcode}', [NotiController::class, 'sendNoti']);