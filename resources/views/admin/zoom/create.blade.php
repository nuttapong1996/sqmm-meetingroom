<x-admin-layout title="สร้าง Link Zoom">
    <x-slot name="AdminContent">
        <div class="flex flex-col justify-center items-center">
            <div class="card w-96 bg-base-100 shadow-sm">
                <div class="card-body">
                    <div class="flex justify-start">
                        <h2 class="text-2xl font-bold">หัวข้อ : {{ $meeting->title }}</h2>
                    </div>
                    <div class="text-xs badge bg-blue-500 text-gray-50 p-2">ร้องขอ Link Zoom</div>
                    <ul class="mt-6 flex flex-col gap-2 text-base">
                        <li><b>ใช้งานวันที่</b></li>
                        <li>
                            <span>{{ $meeting->start_time->thaidate('d M Y') }}</span>
                            <span><b>เวลา : </b>{{ $meeting->start_time->thaidate('H:i') }} น</span>
                        </li>
                        <div class="divider divider-start"><b>ถึงวันที่</b></div>
                        <li>
                            <span>{{ $meeting->start_time->thaidate('d M Y') }}</span>
                            <span><b>เวลา : </b>{{ $meeting->start_time->thaidate('H:i') }} น</span>
                        </li>
                        <li class="mt-3">
                            <span class="text-base"><b>ห้องประชุม : </b> {{ $meeting->room->name }}</span>
                        </li>
                    </ul>
                    <div class="mt-3">
                        <fieldset class="fieldset bg-base-200 border-base-300 rounded-box w-xs border p-4">
                            <legend class="fieldset-legend">Link Zoom</legend>
                            <form class="flex flex-col" action="{{ route('admin.zoom.store', $meeting->id) }}" method="POST" novalidate>
                                @csrf
                                @method('PUT')

                                <input name="zoomUrl" id="zoomUrl" type="text"
                                    class="input validator w-full @error('zoomUrl') input-error @enderror"
                                    placeholder="กรุณากรอก Link Zoom" required pattern=".{3,}"
                                    value="{{ old('zoomUrl') }}"
                                    oninput="this.classList.remove('input-error'); document.getElementById('error-zoomUrl')?.remove();" />
                                @error('zoomUrl')
                                    <div id="error-zoomUrl" class="text-error text-sm mt-1">{{ $message }}</div>
                                @enderror
                                <button class="btn mt-3 bg-blue-500 text-gray-50 join-item hover:bg-blue-700">ตกลง</button>
                            </form>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-admin-layout>
