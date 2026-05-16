<x-app-layout>
    <div class="flex justify-center items-center">
        <fieldset class="fieldset bg-base-100 border-base-300 rounded-box w-xs border p-4 lg:w-lg">
            <!-- เพิ่ม novalidate เพื่อปิดการแจ้งเตือนของเบราว์เซอร์ และให้ Laravel + DaisyUI จัดการแทน -->
            <form action="{{ route('book.store') }}" method="POST" novalidate>
                @csrf
                <legend class="fieldset-legend">จองห้องประชุม</legend>

                <!-- 1. หัวข้อการประชุม -->
                <label class="label text-base mt-2">หัวข้อการประชุม</label>
                <input name="meetingTitle" id="meetingTitle" type="text"
                    class="input validator w-full @error('meetingTitle') input-error @enderror"
                    placeholder="หัวข้อการประชุม" required pattern=".{3,}" value="{{ old('meetingTitle') }}"
                    oninput="this.classList.remove('input-error'); document.getElementById('error-meetingTitle')?.remove();" />
                @error('meetingTitle')
                    <div id="error-meetingTitle" class="text-error text-sm mt-1">{{ $message }}</div>
                @enderror

                <!-- 2. แผนก/ฝ่าย -->
                <label class="label text-base mt-2">แผนก/ฝ่าย</label>
                <select name="meetingDept" id="meetingDept"
                    class="select validator w-full @error('meetingDept') input-error @enderror" required
                    onchange="this.classList.remove('input-error'); document.getElementById('error-meetingDept')?.remove();">
                    <option value="">เลือกแผนก/ฝ่าย</option>
                    @foreach ($depts as $dept)
                        <option value="{{ $dept->code_tbl_deptemp }}"
                            {{ old('meetingDept') == $dept->code_tbl_deptemp ? 'selected' : '' }}>
                            {{ $dept->short_name_deptemp }}
                        </option>
                    @endforeach
                </select>
                @error('meetingDept')
                    <div id="error-meetingDept" class="text-error text-sm mt-1">{{ $message }}</div>
                @enderror


                <!-- 3. ห้องประชุม -->
                <label class="label text-base mt-2">ห้องประชุม</label>
                <select name="meetingRoom" id="meetingRoom"
                    class="select validator w-full @error('meetingRoom') input-error @enderror" required
                    onchange="this.classList.remove('input-error'); document.getElementById('error-meetingRoom')?.remove();">
                    <option value="">เลือกห้องประชุม</option>
                    @foreach ($rooms as $room)
                        <option value="{{ $room->id }}" {{ old('meetingRoom') == $room->id ? 'selected' : '' }}>
                            {{ $room->name }}
                        </option>
                    @endforeach
                </select>
                @error('meetingRoom')
                    <div id="error-meetingRoom" class="text-error text-sm mt-1">{{ $message }}</div>
                @enderror


                <!-- 4. วันที่และเวลา (ปรับ id ไม่ให้ซ้ำกัน และเพิ่ม error state) -->
                <label class="label text-base mt-2" for="start_date">เริ่มใช้</label>
                <input type="text" id="date-picker" name="start_date"
                    class="input date-picker validator  w-full @error('start_date') input-error @enderror"
                    placeholder="เลือกวันที่เริ่มใช้" required value="{{ old('start_date') }}">
                @error('start_date')
                    <div id="error-start_date" class="text-error text-sm mt-1">{{ $message }}</div>
                @enderror


                <label class="label text-base mt-2" for="end_date">สิ้นสุด</label>
                <input type="text" id="date-picker" name="end_date"
                    class="input date-picker validator  w-full @error('end_date') input-error @enderror"
                    placeholder="เลือกวันที่สิ้นสุด" required value="{{ old('end_date') }}">
                @error('end_date')
                    <div id="error-end_date" class="text-error text-sm mt-1">{{ $message }}</div>
                @enderror


                <!-- 5. อุปกรณ์เสริม -->
                <div class="flex flex-col lg:flex-row mt-3">
                    <fieldset class="fieldset bg-base-100 border-base-300 rounded-box mx-2 w-64 border p-4">
                        <legend class="fieldset-legend">Zoom</legend>
                        <label class="label">
                            <input name="zoomUse" type="hidden" value="0" />
                            <input name="zoomUse" type="checkbox" class="checkbox" value="1"
                                {{ old('zoomUse') ? 'checked' : '' }} />
                            ใช้งาน
                        </label>
                    </fieldset>

                    <fieldset class="fieldset bg-base-100 border-base-300 rounded-box mx-2 w-64 border p-4">
                        <legend class="fieldset-legend">เครื่องเสียง</legend>
                        <label class="label">
                            <input name="AudioUse" type="hidden" value="0" />
                            <input name="AudioUse" type="checkbox" class="checkbox" value="1"
                                {{ old('AudioUse') ? 'checked' : '' }} />
                            ใช้งาน
                        </label>
                    </fieldset>
                </div>

                <label class="label text-base mt-3" for="otherEqm">อุปกรณ์อื่นๆ </label>
                <input type="text" name="otherEqm" id="otherEqm" class="input w-full" placeholder="โปรดระบุ"
                    value="{{ old('otherEqm') }}">

                <button class="btn btn-neutral w-full mt-5" type="submit">ตกลง</button>
            </form>
        </fieldset>
    </div>
</x-app-layout>
