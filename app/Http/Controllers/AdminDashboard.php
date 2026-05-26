<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use App\Models\Room;

class AdminDashboard extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roomTotal = Room::count('id');
        $meetingTotal = Meeting::count('id');
        $zoomRequestTotal = Meeting::query()->where('zoom_use', 1)->where('room_status_id', 1)->where('end_time', '>=', now())->count();

        return view('admin.index' , compact('roomTotal' ,'meetingTotal' ,'zoomRequestTotal'));
    }
}
