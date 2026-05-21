<x-app-layout title="รายการจองของฉัน">
    <div class="flex flex-col w-full min-h-screen">
        <div class="text-2xl font-bold text-primary px-4 py-1">รายการจองของฉัน</div>
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
                        <th>Zoom</th>
                        <th>เครื่องเสียง</th>
                        <th>อื่นๆ</th>
                        <th>ยกเลิก</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($meetings as $meeting)
                        <tr class="text-center cursor-pointer hover:bg-base-300" onclick="window.location.href='{{ route('meeting.show', $meeting->id) }}'">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $meeting->title }}</td>
                                <td>{{ $meeting->room->name }}</td>
                                <td>
                                    @if ($meeting->room_status_id == 2)
                                        <span class="badge bg-red-500 text-white p-5">ยกเลิก</span>
                                    @elseif (now() > $meeting->end_time)
                                        <span class="badge bg-green-200 p-5">เสร็จสิ้น</span>
                                    @elseif (now() >= $meeting->start_time && now() <= $meeting->end_time)
                                        <span class="badge bg-green-400  p-5">กำลังใช้</span>
                                    @elseif ($meeting->room_status_id == 1 && now() < $meeting->start_time)
                                        <span class="badge bg-yellow-500 p-5">จองแล้ว</span>
                                    @else
                                        {{ $meeting->status->name ?? 'ไม่ระบุสถานะ' }}
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
                                    {!! $meeting->zoom_use == 1
                                        ? '<a onclick="showLinkZoom(\'' .
                                            $meeting->link_zoom .
                                            '\', \'' .
                                            addslashes($meeting->title) .
                                            '\')" class="btn bg-blue-500 text-gray-50 hover:bg-blue-600" style="cursor:pointer;">link</a>'
                                        : '-' !!}
                                </td>
                                <td>{{ $meeting->audio_system == 1 ? 'ใช้' : '-' }}</td>
                                <td>{{ $meeting->other_equipment }}</td>
                                <td>
                                    @if ($meeting->room_status_id == 2 || now() > $meeting->end_time)
                                        -
                                    @else
                                        <form action="{{ route('meeting.cancel', $meeting->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button type="button" class="btn btn-error text-white"
                                                onclick="cancelMeeting(this.form)">ยกเลิก</button>
                                        </form>
                                    @endif
                                </td>
                            {{-- </a> --}}
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
    </div>
</x-app-layout>


{{-- //TODO  แก้ไขและปรับปรุงตารางรายการจองของฉัน : เพิ่มปุ่มรายละเอียดห้องประชุม , การกรองข้อมูลตามสถานะ ,การข้อใช้งาน Zoom และ เครื่องเสียง --}}

