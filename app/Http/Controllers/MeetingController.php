<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Meeting;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class MeetingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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

        // $validator = Validator::make(
        //     $request->all(),[
        //         'meetingTitle' => 'required',
        //         'meetingDept' => 'required',
        //         'meetingRoom' => 'integer|required',
        //         'start_date' => "date|required|after_or_equal:date",
        //         'end_date' => 'date:required|after:start_date',
        //     ],
        //     [
        //         'meetingTitle.required' => 'กรุณากรอกหัวข้อการประชุม',
        //         'meetingDept.required' => 'การุณาเลือกแผนก/ฝ่าย',
        //         'meetingRoom.required' => 'กรุณาเลือกห้องประชุม',
        //         'start_date.required' => 'กรุณาระบุเวลาเริ่มต้น',
        //         'start_date.after_or_equal' => 'กรุณาระบุเวลาเริ่มต้นให้ถูกต้อง',
        //         'end_date.required' => 'กรุณาระบุเวลาสิ้นสุด',
        //         'end_date.after' => 'กรุณาระบุเวลาสิ้นสุดให้ถูกต้อง',
        //     ]
        // );

        // if($validator->fails()){
        //     return back()->with('error',$validator->errors()->all())->withInput();
        // }
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
