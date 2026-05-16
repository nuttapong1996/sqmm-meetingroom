<?php

use App\Http\Controllers\MeetingController;
use App\Http\Controllers\RoomController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('/meetings', [MeetingController::class, 'getEvents'])->name('meetings.events');
Route::get('/rooms/status', [RoomController::class, 'getRoomStatus'])->name('api.rooms.status');
