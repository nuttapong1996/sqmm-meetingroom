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
        $zoomRequestTotal = Meeting::where('zoom_use', 1)->where('room_status_id', 1)->where('end_time', '>=', now())->count();

        return view('admin.index' , compact('roomTotal' ,'meetingTotal' ,'zoomRequestTotal'));
    }
}
