<x-admin-layout title="รายการจองของฉัน">
    <x-slot name="AdminContent">
        <x-table searchRoute='personal.events'>
            <x-slot name="tableContent">
                <thead>
                    <tr class="text-center">
                        <th>#</th>
                        <th>หัวข้อ</th>
                        <th>ห้อง</th>
                        <th>สถานะ</th>
                        <th>เริ่มใช้</th>
                        <th>สิ้นสุด</th>
                        <th>ยกเลิก</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($meetings as $meeting)
                        <tr class="text-center">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $meeting->title }}</td>
                            <td>{{ $meeting->room->name }}</td>
                            <td>
                                @if ($meeting->link_zoom == null)
                                    <span class="badge bg-yellow-500 text-white p-5">ยังไม่ได้สร้าง</span>
                                @else
                                    <span class="badge bg-blue-500 text-white p-5">สร้างแล้ว</span>
                                @endif
                            </td>
                            <td>
                                {{ $meeting->start_time->thaidate('d M y') }} <br>
                                {{ $meeting->start_time->thaidate('H:i') }} น.
                            </td>
                            <td>
                                {{ $meeting->end_time->thaidate('d M y') }} <br>
                                {{ $meeting->end_time->thaidate('H:i') }} น.
                            </td>
                            <td>
                                @if ($meeting->link_zoom == null)
                                    <a href="{{ route('admin.zoom.create', $meeting->id) }}"
                                        class="btn bg-blue-500 text-gray-50 hover:bg-blue-700">สร้าง</a>
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center px-10 py-10 w-full" colspan="10">
                                <div class="flex flex-col justify-center items-center gap-2">
                                    <span>ไม่พบข้อมูล</span>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </x-slot>
            <x-slot name="tablePage">
                {{ $meetings->links() }}
            </x-slot>
        </x-table>
    </x-slot>
</x-admin-layout>

{{-- //TODO  แก้ไขและปรับปรุงตารางรายการจองทั้งหมด : เพิ่มปุ่มรายละเอียดห้องประชุม , การกรองข้อมูลตามสถานะ ,การข้อใช้งาน Zoom และ เครื่องเสียง --}}