<?php

use App\Http\Controllers\AdminDashboard;
use App\Http\Controllers\CheckEmployee;
use App\Http\Controllers\MeetingController;
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
Route::get('admin/rooms', [RoomController::class, 'index'])->middleware('admin')->name('room.index');
Route::get('admin/room/create',[RoomController::class , 'create'])->middleware('admin')->name('room.create');
Route::post('admin/room/store',[RoomController::class,'store'])->middleware('admin')->name('room.store');
Route::get('admin/room/{room}/edit',[RoomController::class,'edit'])->middleware('admin')->name('room.edit');
Route::put('admin/room/{room}/update',[RoomController::class,'update'])->middleware('admin')->name('room.update');
Route::delete('admin/room/{room}/remove/',[RoomController::class , 'destroy'])->middleware('admin')->name('room.remove');


