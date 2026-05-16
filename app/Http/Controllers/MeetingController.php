<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Meeting;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class MeetingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Meeting::all()->get(
            [
                'title',
                'room_id',
                'emp_code',
                'dept',
                'room_status_id',
            ]
        );
    }

    public function getEvents()
    {
        $meeting = Meeting::with(['room' ,'employee' ,'department'])->get();

        $events = $meeting->map(function ($meeting) {
            return [
                'id' => $meeting->id,
                'title' => '[' . ($meeting->room->name ?? 'ไม่ระบุห้อง') . '] ' . $meeting->title,
                'start' => $meeting->start_time,
                'end' => $meeting->end_time,
                'color' => $meeting->Room->color,
                'extendedProps' => [
                    'subtitle' => $meeting->title,
                    'emp'  => $meeting->employee->name_thai_emp,
                    'dept' => $meeting->department->short_name_deptemp,
                    'room_name' => $meeting->room->name,
                    // 'status' => $meeting->room_status_id,
                    'zoom' => $meeting->zoom_use,
                    'audio' => $meeting->audio_system,
                    'other' => $meeting->other_equipment,
                ]
            ];
        });
        return response()->json($events);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $depts = Department::skip(1)->get();
        $rooms = Room::all();
        return view('meeting.create', compact('rooms', 'depts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'meetingTitle' => 'required',
                'meetingDept' => 'required',
                'meetingRoom' => 'required',
                'start_date' => 'required|date_format:Y-m-d H:i|after_or_equal:now',
                'end_date' => 'required|date_format:Y-m-d H:i|after:start_date',
            ],
            [
                'meetingTitle.required' => 'กรุณากรอกหัวข้อการประชุม',
                'meetingDept.required' => 'การุณาเลือกแผนก/ฝ่าย',
                'meetingRoom.required' => 'กรุณาเลือกห้องประชุม',
                'start_date.required' => 'กรุณาระบุเวลาเริ่มต้น',
                'start_date.date_format'    => 'รูปแบบเวลาไม่ถูกต้อง',
                'start_date.after_or_equal' => 'กรุณาระบุเวลาเริ่มต้นให้ถูกต้อง',
                'end_date.required' => 'กรุณาระบุเวลาสิ้นสุด',
                'end_date.date_format'    => 'รูปแบบเวลาไม่ถูกต้อง',
                'end_date.after' => 'กรุณาระบุเวลาสิ้นสุดให้ถูกต้อง',
            ]
        );

        $startTime = $request['start_date'];
        $endTime = $request['end_date'];
        $roomId = $request['meetingRoom'];

        // 1.Check สถานะห้องและเวลาที่จอง
        $checkStatus = Meeting::where('room_id', $roomId)->where(function ($query) use ($startTime, $endTime) {
            $query->where('start_time', '<', $endTime)->where('end_time', '>', $startTime);
        })->exists();

        // ถ้ามีการทับซ้อน ให้เด้งกลับไปพร้อมแจ้งเตือน
        if ($checkStatus) {
            Alert('จองไม่สำเร็จ', 'ห้องประชุมนี้ถูกจองแล้วในช่วงเวลาดังกล่าว', 'error');
            return back()->withInput();
        }

        // 2. บันทึกข้อมูลลงฐานข้อมูล (เมื่อผ่านทุกเงื่อนไข)
        $meeting = new Meeting();
        $meeting->title = $request['meetingTitle'];
        $meeting->room_id = $roomId;
        $meeting->emp_code = Auth::user()->code_emp;
        $meeting->dept = $request['meetingDept'];
        $meeting->room_status_id = 1;
        $meeting->start_time = $startTime;
        $meeting->end_time = $endTime;
        $meeting->zoom_use = $request['zoomUse'] ?? 0;
        $meeting->audio_system = $request['AudioUse'] ?? 0;
        $meeting->other_equipment = $request['otherEqm'] ?? null;
        $meeting->save();

        Alert('จองสำเร็จ', 'จองห้องประชุมเรียบร้อย', 'success');

        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     */
    public function show(Meeting $meeting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Meeting $meeting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Meeting $meeting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Meeting $meeting)
    {
        //
    }
}
