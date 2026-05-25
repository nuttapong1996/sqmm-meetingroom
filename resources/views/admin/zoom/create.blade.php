<x-admin-layout title="สร้าง Link Zoom">
    {{-- <x-slot name="breadcrumbs">

    </x-slot> --}}
    <x-slot name="AdminContent">
        <div class="flex flex-col justify-center items-center ">
            <div class="card w-96 bg-base-100  shadow-sm">
                <div class="card-body">
                    <div class="flex justify-start">
                        <h2 class="text-xl font-bold">หัวข้อ : {{ $meeting->title }}</h2>
                    </div>
                    <ul class="flex flex-col list border border-gray-300 bg-gray-100 text-gray-800 p-3 rounded-box">
                        <li>
                            <span><b>ผู้ร้องขอ : </b>คุณ {{ $meeting->employee->name_thai_emp }}</span>
                        </li>
                        <li>
                            <span><b>แผนก/ฝ่าย : </b>{{ $meeting->department->short_name_deptemp }}</span>
                        </li>
                        <li>
                            <span><b>ห้องประชุม : </b> {{ $meeting->room->name }}</span>
                        </li>
                    </ul>
                    <div class="border border-gray-300 bg-gray-100 text-gray-800 p-3 rounded-box">
                        <span><b>ใช้งาน :</b>
                            {{ $meeting->start_time->thaidate('d/m/y') }}
                            {{ $meeting->start_time->thaidate('H:i') }} น.<b> - </b>
                            {{ $meeting->end_time->thaidate('d/m/y') }}
                            {{ $meeting->end_time->thaidate('H:i') }} น.
                        </span>
                    </div>
                    <div>
                        <fieldset
                            class="fieldset border border-gray-300 bg-gray-100 text-gray-800 rounded-box  border p-4">
                            <legend class="fieldset-legend">
                                <div class="text-xs badge bg-blue-500 text-gray-50 p-2">ร้องขอ Link Zoom</div>
                            </legend>
                            <form class="flex flex-col" action="{{ route('admin.zoom.store', $meeting->id) }}"
                                method="POST" novalidate>
                                @csrf
                                @method('PUT')
                                <labe for="zoomUrl" class="label text-gray-600 p-2">Meeting URL</labe>
                                <input name="zoomUrl" id="zoomUrl" type="text"
                                    class="input validator w-full @error('zoomUrl') input-error @enderror"
                                    placeholder="กรุณากรอก Link Zoom" required pattern=".{3,}"
                                    value="{{ old('zoomUrl') }}" autocomplete="off"
                                    oninput="this.classList.remove('input-error'); document.getElementById('error-zoomUrl')?.remove();" />
                                @error('zoomUrl')
                                    <div id="error-zoomUrl" class="text-error text-sm mt-1">{{ $message }}</div>
                                @enderror
                                <labe for="zoomID" class="label text-gray-600  p-2">Meeting ID</labe>
                                <input name="zoomID" id="zoomID"
                                    class="input validator w-full @error('zoomID') input-error @enderror"
                                    value="{{ old('zoomID') }}" autocomplete="off"
                                    placeholder="กรุณากรอก Meeting ID" required pattern=".{3,}"
                                    oninput="this.classList.remove('input-error'); document.getElementById('error-zoomID')?.remove();"
                                    type="text">
                                @error('zoomID')
                                    <div id="error-zoomID" class="text-error text-sm mt-1">{{ $message }}</div>
                                @enderror
                                <labe for="zoomPasscode" class="label text-gray-600 p-2">Meeting Passcode</labe>
                                <input name="zoomPasscode" id="zoomPasscode"
                                    class="input validator w-full @error('zoomPasscode') input-error @enderror"
                                    value="{{ old('zoomPasscode') }}" autocomplete="off"
                                    placeholder="กรุณากรอก Meeting Passcode" required pattern=".{3,}"
                                    oninput="this.classList.remove('input-error'); document.getElementById('error-zoomPass')?.remove();"
                                    type="text">
                                @error('zoomPasscode')
                                    <div id="error-zoomPass" class="text-error text-sm mt-1">{{ $message }}</div>
                                @enderror
                                <button
                                    class="btn mt-3 bg-blue-500 text-gray-50 join-item hover:bg-blue-700">ตกลง</button>
                            </form>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-admin-layout>
