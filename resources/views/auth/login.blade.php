<x-app-layout title="เข้าสู่ระบบ">
    <div class="flex flex-col justify-center items-center h-100">
        <img class="w-20 h-20" src="{{ asset('images/logo.png') }}">
        <h2 class="text-xl-center mt-2 mb-2">ระบบจองห้องประชุม</h2>
        <fieldset class="fieldset bg-white bg-base-200 border-base-300 rounded-box w-xs border p-4">
            <legend class="fieldset-legend text-gray-100 bg-neutral p-2 rounded-3xl">เข้าสู่ระบบ</legend>
            <form class="fieldset w-xs" action="{{ route('check-emp') }}" method="POST" novalidate>
                @csrf
                <fieldset class="fieldset mb-3">
                    <legend class="fieldset-legend">รหัสพนักงาน</legend>
                    <input class="input validator @error('empcode') input-error @enderror" type="text"
                        placeholder="รหัสพนักงาน" name="empcode" id="empcode" autocomplete="off"
                        oninput="this.classList.remove('input-error'); document.getElementById('error-empCode')?.remove();"
                        value="{{ old('empcode') }}" required/>
                    @error('empcode')
                        <p id="error-empCode" class="text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </fieldset>
                <fieldset class="fieldset mb-3">
                    <legend class="fieldset-legend">วันเดือนปีเกิด (ค.ศ)</legend>
                    <input
                        class="input date-picker validator @error('empBdate')
                        input-error
                        @enderror"
                        type="text" placeholder="วัน/เดือน/ปี (ค.ศ)" name="empBdate" id="empBdate"
                        oninput="this.classList.remove('input-error'); document.getElementById('errorBdate')?.remove();"
                        value="{{ old('empBdate') }}" required autocomplete="off">
                    @error('empBdate')
                        <p class="text-xs text-red-500" id="errorBdate">{{ $message }}</p>
                    @enderror
                </fieldset>
                <button class="btn btn-neutral mt-4" type="submit">Login</button>
            </form>

        </fieldset>
    </div>
</x-app-layout>
