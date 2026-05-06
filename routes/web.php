<?php

use App\Http\Controllers\CheckEmployee;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('login', [CheckEmployee::class, 'index'])->middleware('guest')->name('login');
Route::post('login', [CheckEmployee::class, 'login'])->name('check-emp');
Route::get('logout', [CheckEmployee::class, 'logout'])->name('logout');


Route::get('manage', function () {
    return view('manage.home');
})->middleware('admin')->name('manage');

Route::get('manage/rooms', [RoomController::class, 'index'])->middleware('admin')->name('manage.room');
Route::get('room/create',[RoomController::class , 'create'])->middleware('admin')->name('room.create');
Route::post('room/create',[RoomController::class,'store'])->middleware('admin')->name('room.store');
