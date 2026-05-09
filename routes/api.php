<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::get('/meetings', function (Request $request) {
    // FullCalendar ต้องการรูปแบบ: title, start, end
    return 'hello';
});
// })->middleware('auth:sanctum');


