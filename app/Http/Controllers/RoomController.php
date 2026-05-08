<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
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
        $validator = Validator::make(
            $request->all(),
            [
                'roomName' => 'required|unique:rooms,name',
                'roomColor' => 'unique:rooms,color',
                'roomPic'   => "nullable|image|max:2048",
            ],
            [
                'roomName.required' => 'กรุณากรอกชื่อห้องประชุม',
                'roomName.unique' => 'ชื่อห้องนี้ซ้ำ กรุณาเลือกชื่อใหม่',
                'roomColor.unique' => 'กรุณาเลือกสีอื่น',
                'roomPic.image' => 'ต้องเป็นไฟล์รูปเท่านั้น',
                'roomPic.max' => 'ไฟล์รูปต้องมีขนาดไม่เกิน 2 MB',
            ]
        );

        if ($validator->fails()) {
            return back()->with('error', $validator->errors()->all())->withInput();
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
        Alert::success('เพิ่มข้อมูลสำเร็จ', 'เพิ่มห้องประชุมแล้ว');
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
    public function edit(Room $room)
    {
        return view('admin.room.edit', compact('room'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Room $room)
    {

        // 1. Validation
        $validator = Validator::make($request->all(), [
            'roomColor' => "unique:rooms,color,{$room->id}",
            'roomPic'   => "nullable|image|max:2048", // เพิ่ม validation รูปด้วยเพื่อความปลอดภัย
        ], [
            'roomColor.unique' => 'กรุณาเลือกสีอื่น',
            'roomPic.image' => 'ต้องเป็นไฟล์รูปเท่านั้น',
            'roomPic.max' => 'ไฟล์รูปต้องมีขนาดไม่เกิน 2 MB',
        ]);

        if ($validator->fails()) {
            return back()->with('error', $validator->errors()->all());
        }

        try {
            // 2. จัดการเรื่องรูปภาพ
            $path = $room->pic; // กำหนดค่าเริ่มต้นเป็นพาธเดิมจาก DB (กันรูปหาย)

            if ($request->hasFile('roomPic')) {
                // ลบรูปเก่าออกก่อน (ถ้ามี)
                if ($room->pic && Storage::disk('public')->exists($room->pic)) {
                    Storage::disk('public')->delete($room->pic);
                }

                // อัปโหลดรูปใหม่
                $image = $request->file('roomPic');
                $newFileName = $room->name . '_' . time() . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('rooms', $newFileName, 'public');
            }

            // 3. อัปเดตข้อมูล (ใช้ตัวแปร $room ที่มีอยู่แล้วได้เลย)
            $room->update([
                'pic'   => $path,
                'color' => $request->roomColor,
                // 'name'  => $request->roomName, // อย่าลืมอัปเดตชื่อถ้ามีการแก้ไข
            ]);

            Alert::success('อัพเดทข้อมูลสำเร็จ', 'อัพเดทข้อมูลของห้องประชุม ' . $room->name);
            return redirect()->route('room.index');
        } catch (\Exception $e) {
            Alert::error('อัพเดทข้อมูลไม่สำเร็จ', 'เกิดข้อผิดพลาด: ' . $e->getMessage());
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        if ($room->pic && Storage::disk('public')->exists($room->pic)) {
            Storage::disk('public')->delete($room->pic);
        }

        room::destroy($room->id);
        Alert::success('ลบข้อมูลสำเร็จ', 'ข้อมูลห้องถูกลบออกจากระบบแล้ว');
        return redirect()->route('room.index');
    }
}
