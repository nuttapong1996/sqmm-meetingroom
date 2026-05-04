<?php

use App\Http\Controllers\CheckEmployee;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('login' , [CheckEmployee::class,'index'])->middleware('guest')->name('login');
Route::post('login',[CheckEmployee::class , 'login'])->name('check-emp');
Route::get('logout' ,[CheckEmployee::class , 'logout'])->name('logout');


Route::get('/manage/room' , function(){
    return view('manage.rooms');
})->middleware('admin')->name('manage-rooms');