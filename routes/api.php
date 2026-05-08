<?php

use App\Models\Meeting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::get('/meetings', function (Request $request) {
    // FullCalendar ต้องการรูปแบบ: title, start, end
    return Meeting::all()->map(function ($meeting) {
        return [
            'id'    => $meeting->id,
            'title' => $meeting->room->name . ' - ' . $meeting->purpose,
            'start' => $meeting->start_time,
            'end'   => $meeting->end_time,
            'color' => $meeting->room->color, // ใช้สีที่เราตั้งค่าไว้ใน DB
        ];
    });
});


