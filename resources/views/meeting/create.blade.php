<x-app-layout>
    <fieldset class="fieldset bg-base-100 border-base-300 rounded-box w-xs border p-4 lg:w-lg">
        <form action="{{ route('book.store') }}" method="POST">
            @csrf
            <legend class="fieldset-legend">จองห้องประชุม</legend>

            <label class="label text-base mt-2">หัวข้อการประชุม</label>
            <input name="meetingTitle" type="text" class="input w-full" placeholder="หัวข้อการประชุม" />

            <label class="label text-base mt-2">แผนก/ฝ่าย</label>
            <select name="meetingDept" class="select w-full">
                @foreach ($depts as $dept)
                    <option value="{{ $dept->code_tbl_deptemp }}">{{ $dept->short_name_deptemp }}</option>
                @endforeach
            </select>

            <label class="label text-base mt-2">ห้องประชุม</label>
            <select name="meetingRoom" class="select w-full">
                @foreach ($rooms as $room)
                    <option value="{{ $room->id }}">{{ $room->name }}</option>
                @endforeach
            </select>
            <label class="label text-base mt-2" for="booking_date">เริ่มใช้</label>
            <input type="text" id="date-picker" name="start_date" class="input w-full"
                placeholder="เลือกวันที่เริ่มใช้">

            <label class="label text-base mt-2" for="booking_date">สิ้นสุด</label>
            <input type="text" id="date-picker" name="end_date" class="input w-full"
                placeholder="เลือกวันที่สิ้นสุด">

            <div class="flex flex-col lg:flex-row mt-3">
                <fieldset class="fieldset bg-base-100 border-base-300 rounded-box mx-2 w-64 border p-4">
                    <legend class="fieldset-legend">Zoom</legend>
                    <label class="label">
                        <input name="zoomUse" type="checkbox" class="checkbox" value="1" />
                        <input name="zoomUse" type="hidden" value="0" />
                        ใช้งาน
                    </label>
                </fieldset>
                <fieldset class="fieldset bg-base-100 border-base-300 rounded-box mx-2 w-64 border p-4">
                    <legend class="fieldset-legend">เครื่องเสียง</legend>
                    <label class="label">
                        <input name="AudioUse" type="checkbox" class="checkbox" value="1" />
                        <input name="AudioUse" type="hidden" value="0" />
                        ใช้งาน
                    </label>
                </fieldset>
            </div>
            <label class="label text-base mt-3" for="booking_date">อุปกรณ์อื่นๆ </label>
            <input type="text" name="otherEqm" class="input w-full" placeholder="โปรดระบุ">

            <button class="btn btn-neutral w-full mt-5" type="submit">ตกลง</button>
        </form>
    </fieldset>
</x-app-layout>
