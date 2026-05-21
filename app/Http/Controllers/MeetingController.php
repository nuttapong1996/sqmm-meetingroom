<?php

namespace App\Http\Controllers;

use App\Http\Controllers\NotificationController;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Meeting;
use App\Models\Room;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        $meeting = Meeting::with(['room', 'employee', 'department'])->where('room_status_id', '=', 1)->get();

        $events = $meeting->map(function ($meeting) {
            return [
                'id' => $meeting->id,
                'title' => $meeting->title,
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

    public function personalMeeting(Request $request)
    {
        $search = $request->input('search');
        $limit = $request->input('limit', 5);
        $empcode = Auth::user()->code_emp;

        $meetings = Meeting::query()->when($search, function ($query, $search) {
            return $query->where('title', 'like', "%{$search}%");
        })->with(['room', 'employee', 'department', 'status'])->orderBy('id', 'desc')->where('emp_code', $empcode)
            ->paginate($limit)
            ->withQueryString();

        // $meeting = Meeting::with(['room', 'employee', 'department'])->where('emp_code', $empcode)->get();

        if (!$meetings) {
            return http_response_code(404);
        }
        return view('meeting.personal', compact('search', 'meetings'));
    }

    public function adminMeetingManage(Request $request)
    {
        $search = $request->input('search');
        $limit = $request->input('limit', 5);

        $meetings =  Meeting::query()->when($search, function ($query, $search) {
            return $query->where('title', 'like', "%{$search}%");
        })->with(['room', 'employee', 'department', 'status'])->orderBy('id', 'desc')
            ->paginate($limit)
            ->withQueryString();

        if (!$meetings) {
            return http_response_code(404);
        }

        return view('admin.meeting.list', compact('meetings', 'search'));
    }

    public function zoomList(Request $request)
    {
        $search = $request->input('search');
        $limit = $request->input('limit', 5);

        $meetings =  Meeting::query()->when($search, function ($query, $search) {
            return $query->where('title', 'like', "%{$search}%");
        })->where('zoom_use', 1)->with(['room', 'employee', 'department', 'status'])->orderBy('id', 'desc')
            ->paginate($limit)
            ->withQueryString();

        if (!$meetings) {
            return http_response_code(404);
        }

        return view('admin.zoom.list', compact('meetings', 'search'));
    }

    public function zoomCreate(Request $request)
    {
        $meeting = Meeting::where('id', $request['id'])->first();
        return view('admin.zoom.create', compact('meeting'));
    }

    public function zoomStore(Request $request)
    {


        $request->validate(
            [
                'zoomUrl' => 'required|string',
            ],
            [
                'zoomUrl.required' => 'กรุณากรอกลิงก์ Zoom',
            ]
        );

        $ZoomUrl = $request['zoomUrl'];
        $MeetingID = $request['id'];

        Meeting::where('id', $MeetingID)->update([
            'link_zoom' => $ZoomUrl
        ]);

        $meeting = Meeting::where('id', $request['id'])->first();
        // 1. ค้นหา Employee จาก emp_code
        $requester = Employee::where('code_emp', $meeting->emp_code)->first();

        // 2. เช็คก่อนว่ามีพนักงานคนนี้จริงๆ ค่อยส่งแจ้งเตือน
        if ($requester) {
            NotificationController::send(
                $requester, // 
                'Admin ได้เพิ่มลิงก์ Zoom ของ ' . $meeting->title . ' แล้ว',
                route('meeting.show', $meeting->id),
                $MeetingID,
                $meeting->title
            );

            $adminGroup = config('auth.admin_users', []);
            // $admins = Employee::whereIn('code_emp', $adminGroup)->get();
            $adminIds = Employee::whereIn('code_emp', $adminGroup)->pluck('code_emp');

            DB::table('notifications')
                ->where('type', 'App\Notifications\RealtimeNotification')
                ->whereIn('notifiable_id', $adminIds) // ค้นหาเจาะจงใน JSON
                ->where('data->meeting_id', $MeetingID) // ค้นหาเจาะจงใน JSON
                ->update(['read_at' => now()]);
        }

        Alert::success('สำเร็จ', 'บันทึกลิงก์ Zoom เรียบร้อยแล้ว');


        return redirect()->route('admin.zoom.list');
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
            $query->where('start_time', '<', $endTime)->where('end_time', '>', $startTime)->where('room_status_id', '=', 1);
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

        if ($meeting->zoom_use == 1) {
            $adminGroup = config('auth.admin_users', []);
            $admins = Employee::whereIn('code_emp', $adminGroup)->get();
            NotificationController::send($admins, 'มีผู้ร้องขอ Link Zoom', route('admin.zoom.create', $meeting->id), $meeting->id, $meeting->title);
        }

        return redirect()->route('home');
    }


    public function show($id)
    {

        $meeting = Meeting::findOrFail($id);

        if (Auth::user()->cannot('view', $meeting)) {
            return redirect()->route('home');
        }

        return view('meeting.show' , compact('meeting'));
    }


    public function adminCancelMeeting(Request $request)
    {
        $MeetingID = $request['id'];

        Meeting::where('id', $MeetingID)->update([
            'room_status_id' => 2
        ]);

        Alert('สำเร็จ', 'ยกเลิกการจองเรียบร้อยแล้ว', 'success');

        return redirect()->route('admin.meeting.list');
    }

    public function cancelMeeting(Request $request)
    {
        $MeetingID = $request['id'];

        Meeting::where('id', $MeetingID)->update([
            'room_status_id' => 2
        ]);

        Alert('สำเร็จ', 'ยกเลิกการจองเรียบร้อยแล้ว', 'success');

        return redirect()->route('personal.events');
    }
}


// TODO : แก้ไข function zoomStore ให้เก็บ passcode และ password ของ Zoom