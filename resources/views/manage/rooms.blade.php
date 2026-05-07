<x-admin-layout title="การจัดการห้องประชุม">
    <x-slot name="AdminContent">
        <div class="flex flex-col">
            {{-- Table Nav (div1) --}}
            <div class="navbar rounded-2xl p-3 bg-base-100 shadow-sm  flex flex-col lg:flex-row justify-between ">
                {{-- <div> --}}
                <form class="join" method="GET" action="{{ route('room.index') }}">
                    <label class="input join-item">
                        <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <g stroke-linejoin="round" stroke-linecap="round" stroke-width="2.5" fill="none"
                                stroke="currentColor">
                                <circle cx="11" cy="11" r="8"></circle>
                                <path d="m21 21-4.3-4.3"></path>
                            </g>
                        </svg>
                        <input type="text" placeholder="ค้นหา" name="search" value="{{ $search }}" />
                    </label>
                    <button class="btn btn-neutral join-item" type="submit">ค้นหา</button>
                    @if ($search)
                        <a href="{{ route('room.index') }}" class="btn btn-error join-item text-white">ล้าง</a>
                    @endif
                </form>

                {{-- </div> --}}
                <a class="btn btn-success flex-nowrap mt-3 lg:mt-0" href="{{ route('room.create') }}">
                    <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22ZM12.75 9C12.75 8.58579 12.4142 8.25 12 8.25C11.5858 8.25 11.25 8.58579 11.25 9L11.25 11.25H9C8.58579 11.25 8.25 11.5858 8.25 12C8.25 12.4142 8.58579 12.75 9 12.75H11.25V15C11.25 15.4142 11.5858 15.75 12 15.75C12.4142 15.75 12.75 15.4142 12.75 15L12.75 12.75H15C15.4142 12.75 15.75 12.4142 15.75 12C15.75 11.5858 15.4142 11.25 15 11.25H12.75V9Z"
                                fill="#1C274C"></path>
                        </g>
                    </svg>
                    <span>เพิ่มห้อง</span>
                </a>
            </div>
            {{-- ตาราง --}}
            <div class="mt-5">
                <div class="overflow-x-auto">
                    <table class="table table-bordered">
                        <!-- head -->
                        <thead>
                            <tr class="text-center">
                                <th>#</th>
                                <th>รูป</th>
                                <th>ชื่อ</th>
                                <th>สี</th>
                                <th>แก้ไข</th>
                                <th>ลบ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($rooms as $room)
                                <tr class="text-center">
                                    <td>{{ $loop->iteration }}</td>
                                    <td><img class="w-20 h-20 object-cover mx-auto block"
                                            src="{{ !empty($room['pic']) ? asset('storage/' . $room['pic']) : asset('images/no_image.jpg') }}"
                                            alt=""></td>
                                    <td class="text-base">{{ $room['name'] }}</td>
                                    <td class="text-base"><span class="badge px-5"
                                            style="background-color:{{ $room['color'] }}"></span></td>
                                    <td><a class="btn btn-primary" href="#{{ $room['id'] }}">แก้ไข</a></td>
                                    <td class="w-20">
                                        <form action="{{ route('room.remove', $room['id']) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-error text-white"
                                                onclick="confirmDelete(this.form)">ลบ</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center px-10 py-10" colspan="6">
                                        <div class="flex flex-col items-center gap-2">
                                            <span>ไม่พบข้อมูลห้องประชุม</span>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mt-6 flex flex-col justify-center lg:flex-row lg:justify-between items-center ">
                <div class="flex flex-row items-center">
                    <span>แสดงรายการ</span>
                    <form class="px-5" action="{{ route('room.index') }}" method="GET">
                        <select class="select" name='limit' onchange="this.form.submit()">
                            {{-- @if (request('search'))
                                <input type="hidden" name="search" value="{{ request('search') }}">
                            @endif --}}
                            @php $currentLimit = request('limit', 5); @endphp
                            <option value="5" @selected($currentLimit == 5)>5</option>
                            <option value="10" @selected($currentLimit == 10)>10</option>
                            <option value="25" @selected($currentLimit == 30)>30</option>
                            <option value="50" @selected($currentLimit == 50)>50</option>
                            <option value="100" @selected($currentLimit == 100)>100</option>
                        </select>
                    </form>
                    <span>แถว</span>
                </div>
                {{ $rooms->links() }}
            </div>
        </div>
        <script>
            function confirmDelete(form) {
                // สามารถเรียกใช้ Swal ได้เลย เพราะเราประกาศ window.Swal ไว้ใน app.js แล้ว
                Swal.fire({
                    title: 'ยืนยันการลบ?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ef4444',
                    confirmButtonText: 'ใช่, ลบเลย!'
                }).then((result) => {
                    if (result.isConfirmed) form.submit();
                });
            }
        </script>
    </x-slot>

</x-admin-layout>
