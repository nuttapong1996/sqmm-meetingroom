<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $limit = $request->input('limit', 5);

        $rooms = Room::query()->when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%");
        })->orderBy('id', 'asc')
            ->paginate($limit)
            ->withQueryString();

        return view('admin.room.index', compact('search', 'rooms'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('admin.room.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request['roomName']);
        $validator = Validator::make(
            $request->all(),
            [
                'roomName' => 'required|unique:rooms,name',
            ],
            [
                'roomName.required' => 'กรุณากรอกชื่อห้องประชุม',
                'roomName.unique' => 'ชื่อห้องนี้ซ้ำ กรุณาเลือกชื่อใหม่',
            ]
        );

        if ($validator->fails()) {
            return back()->with('error', $validator->errors()->first())->withInput();
        }

        if ($request->hasFile('roomPic')) {
            $image = $request->file('roomPic');


            // Create new name: filename_timestamp.extension
            $newFileName = $request['roomName'] . '_' . time() . '.' . $image->getClientOriginalExtension();


            $path = $request->file('roomPic')->storeAs('rooms', $newFileName, 'public');
        } else {
            $path = null;
        }


        Room::create([
            'name' => $request['roomName'],
            'pic' => $path,
            'color' => $request['roomColor']
        ]);
        Alert::success('เพิ่มข้อมูลสำเร็จ' , 'เพิ่มห้องประชุมแล้ว');
        return redirect()->route('room.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(room $room)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(room $room)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, room $room)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        room::destroy($request['id']);
        
        Alert::success('ลบข้อมูลสำเร็จ', 'ข้อมูลห้องถูกลบออกจากระบบแล้ว');
        return redirect()->route('room.index');
    }
}
