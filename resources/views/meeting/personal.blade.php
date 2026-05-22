<x-app-layout title="รายการจองของฉัน">
    <div class="flex flex-col w-full min-h-screen p-4 md:p-6 bg-gray-50">
        <div class="text-2xl font-bold text-primary mb-6">รายการจองของฉัน</div>
        <x-table searchRoute='personal.events'>
            <x-slot name="tableContent">

                <thead class="hidden lg:table-header-group bg-gray-100 border-b-2 border-gray-200">
                    <tr class="lg:table-row">
                        <th class="lg:table-cell px-4 py-3 text-left font-semibold text-gray-700 w-16">#</th>
                        <th class="lg:table-cell px-4 py-3 text-left font-semibold text-gray-700">หัวข้อ</th>
                        <th class="lg:table-cell px-4 py-3 text-left font-semibold text-gray-700">ห้อง</th>
                        <th class="lg:table-cell px-4 py-3 text-center font-semibold text-gray-700">สถานะ</th>
                        <th class="lg:table-cell px-4 py-3 text-center font-semibold text-gray-700">เริ่มใช้</th>
                        <th class="lg:table-cell px-4 py-3 text-center font-semibold text-gray-700">สิ้นสุด</th>
                        <th class="lg:table-cell px-4 py-3 text-center font-semibold text-gray-700">Zoom</th>
                        <th class="lg:table-cell px-4 py-3 text-center font-semibold text-gray-700">เครื่องเสียง</th>
                        <th class="lg:table-cell px-4 py-3 text-center font-semibold text-gray-700 w-24">รายละเอียด</th>
                        <th class="lg:table-cell px-4 py-3 text-center font-semibold text-gray-700 w-24">ยกเลิก</th>
                    </tr>
                </thead>

                <tbody class="block lg:table-row-group divide-y divide-gray-100">
                    @forelse ($meetings as $meeting)
                        <tr
                            class="block lg:table-row bg-white border border-gray-200 lg:border-none mb-4 lg:mb-0 rounded-lg lg:rounded-none shadow-sm lg:shadow-none hover:bg-gray-50 transition">

                            <td
                                class="block lg:table-cell px-4 py-3 border-gray-100 border-b lg:border-none relative pl-32 lg:pl-4 text-gray-800">
                                <span class="lg:hidden absolute left-4 top-3 font-semibold text-gray-500">ลำดับ:</span>
                                {{ $loop->iteration }}
                            </td>

                            <td
                                class="block lg:table-cell px-4 py-3 border-gray-100 border-b lg:border-none relative pl-32 lg:pl-4 font-medium text-gray-900">
                                <span class="lg:hidden absolute left-4 top-3 font-semibold text-gray-500">หัวข้อ:</span>
                                {{ $meeting->title }}
                            </td>

                            <td
                                class="block lg:table-cell px-4 py-3 border-gray-100 border-b lg:border-none relative pl-32 lg:pl-4 text-gray-600">
                                <span class="lg:hidden absolute left-4 top-3 font-semibold text-gray-500">ห้อง:</span>
                                {{ $meeting->room->name }}
                            </td>

                            <td
                                class="block lg:table-cell px-4 py-3 border-gray-100 border-b lg:border-none relative pl-32 lg:pl-4 lg:text-center">
                                <span class="lg:hidden absolute left-4 top-3 font-semibold text-gray-500">สถานะ:</span>
                                @if ($meeting->room_status_id == 2)
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">ยกเลิก</span>
                                @elseif (now() > $meeting->end_time)
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">เสร็จสิ้น</span>
                                @elseif (now() >= $meeting->start_time && now() <= $meeting->end_time)
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">กำลังใช้</span>
                                @elseif ($meeting->room_status_id == 1 && now() < $meeting->start_time)
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">จองแล้ว</span>
                                @else
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">{{ $meeting->status->name ?? 'ไม่ระบุสถานะ' }}</span>
                                @endif
                            </td>

                            <td
                                class="block lg:table-cell px-4 py-3 border-gray-100 border-b lg:border-none relative pl-32 lg:pl-4 lg:text-center text-sm text-gray-600">
                                <span class="lg:hidden absolute left-4 top-3 font-semibold text-gray-500">เริ่ม:</span>
                                {{ $meeting->start_time->thaidate('d M y') }} <span class="hidden lg:inline text-gray-400 mx-1">|</span>
                                {{ $meeting->start_time->thaidate('H:i') }} น.
                            </td>

                            <td
                                class="block lg:table-cell px-4 py-3 border-gray-100 border-b lg:border-none relative pl-32 lg:pl-4 lg:text-center text-sm text-gray-600">
                                <span
                                    class="lg:hidden absolute left-4 top-3 font-semibold text-gray-500">สิ้นสุด:</span>
                                {{ $meeting->end_time->thaidate('d M y') }} <span class="hidden lg:inline text-gray-400 mx-1">|</span>
                                {{ $meeting->end_time->thaidate('H:i') }} น.
                            </td>

                            <td
                                class="block lg:table-cell px-4 py-3 border-gray-100 border-b lg:border-none relative pl-32 lg:pl-4 lg:text-center">
                                <span class="lg:hidden absolute left-4 top-3 font-semibold text-gray-500">Zoom:</span>
                                @if ($meeting->zoom_use == 1)
                                    <span class="text-blue-600 font-semibold">ใช้</span>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>

                            <td
                                class="block lg:table-cell px-4 py-3 border-gray-100 border-b lg:border-none relative pl-32 lg:pl-4 lg:text-center">
                                <span
                                    class="lg:hidden absolute left-4 top-3 font-semibold text-gray-500">เครื่องเสียง:</span>
                                @if ($meeting->audio_system == 1)
                                    <span class="text-blue-600 font-semibold">ใช้</span>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>

                            <td class="block lg:table-cell px-4 py-3 relative pl-32 lg:pl-4 lg:text-center">
                                <span
                                    class="lg:hidden absolute left-4 top-3 font-semibold text-gray-500">รายละเอียด:</span>
                                <a class="inline-flex justify-center items-center w-full p-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition shadow-sm"
                                    href="{{ route('meeting.show', $meeting->id) }}" title="รายละเอียด">
                                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M20 3H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2zm-9 14H5v-2h6v2zm8-4H5v-2h14v2zm0-4H5V7h14v2z">
                                        </path>
                                    </svg>
                                </a>
                            </td>
                            <td class="block lg:table-cell px-4 py-3 relative pl-32 lg:pl-4 lg:text-center">
                                <span class="lg:hidden absolute left-4 top-3 font-semibold text-red-500">ยกเลิก:</span>
                                @if ($meeting->room_status_id == 2 || now() > $meeting->end_time)
                                    -
                                @else
                                    <form action="{{ route('admin.meeting.cancel', $meeting->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="button" class="inline-flex justify-center items-center cursor-pointer w-full p-2 bg-red-500 text-white rounded-md hover:bg-red-600 transition shadow-sm"
                                            onclick="cancelMeeting(this.form)">
                                            <svg class="w-5 h-5 text-gray-50 fill-current" viewBox="0 0 32 32"
                                                version="1.1" xmlns="http://www.w3.org/2000/svg">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                    stroke-linejoin="round"></g>
                                                <g id="SVGRepo_iconCarrier">
                                                    <title>cancel</title>
                                                    <path
                                                        d="M10.771 8.518c-1.144 0.215-2.83 2.171-2.086 2.915l4.573 4.571-4.573 4.571c-0.915 0.915 1.829 3.656 2.744 2.742l4.573-4.571 4.573 4.571c0.915 0.915 3.658-1.829 2.744-2.742l-4.573-4.571 4.573-4.571c0.915-0.915-1.829-3.656-2.744-2.742l-4.573 4.571-4.573-4.571c-0.173-0.171-0.394-0.223-0.657-0.173v0zM16 1c-8.285 0-15 6.716-15 15s6.715 15 15 15 15-6.716 15-15-6.715-15-15-15zM16 4.75c6.213 0 11.25 5.037 11.25 11.25s-5.037 11.25-11.25 11.25-11.25-5.037-11.25-11.25c0.001-6.213 5.037-11.25 11.25-11.25z">
                                                    </path>
                                                </g>
                                            </svg></button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr class="block lg:table-row">
                            <td class="block lg:table-cell px-4 py-8 text-center text-gray-500" colspan="9">
                                <div class="flex flex-col justify-center items-center gap-2">
                                    <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                                        </path>
                                    </svg>
                                    <span>ไม่พบข้อมูลการจอง</span>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </x-slot>
            <x-slot name="tablePage">
                <div class="mt-4">
                    {{ $meetings->links() }}
                </div>
            </x-slot>
        </x-table>
    </div>
</x-app-layout>


{{-- //TODO  แก้ไขและปรับปรุงตารางรายการจองของฉัน : เพิ่มปุ่มรายละเอียดห้องประชุม , การกรองข้อมูลตามสถานะ ,การข้อใช้งาน Zoom และ เครื่องเสียง --}}
