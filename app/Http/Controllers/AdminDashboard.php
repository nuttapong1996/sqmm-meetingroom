<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use App\Models\room;
use Illuminate\Http\Request;

class AdminDashboard extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roomTotal = room::count();
        $meetingTotal = Meeting::count();

        return view('admin.index' , compact('roomTotal' ,'meetingTotal'));
    }
}
