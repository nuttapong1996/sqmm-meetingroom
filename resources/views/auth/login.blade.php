<x-app-layout title="เข้าสู่ระบบ">
    <fieldset class="fieldset bg-white bg-base-200 border-base-300 rounded-box w-xs border p-4">
        <legend class="fieldset-legend text-gray-100 bg-neutral p-2 rounded-3xl">เข้าสู่ระบบ</legend>
        <form class="fieldset w-xs" action="{{ route('check-emp') }}" method="POST">
            @csrf
           <x-error-alert></x-error-alert>
            <div class="flex flex-col">
                <label class="label">รหัสพนักงาน</label>
                <input type="text" class="input" placeholder="รหัสพนักงาน" name="empcode" id="empcode"
                    autocomplete="off" />
            </div>
            {{-- <p class="validator-hint hidden">กรุณากรอกรหัสพนักงาน</p> --}}

            {{-- <label class="label">Password</label>
        <input type="password" class="input" placeholder="Password" /> --}}

            <button class="btn btn-neutral mt-4" type="submit">Login</button>
        </form>

    </fieldset>
</x-app-layout>
