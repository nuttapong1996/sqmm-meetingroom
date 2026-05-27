<x-app-layout title="เข้าสู่ระบบ">
    <div class="flex flex-col justify-center items-center h-100">
        <fieldset class="fieldset bg-white bg-base-200 border-base-300 rounded-box w-xs border p-4">
            <legend class="fieldset-legend text-gray-100 bg-neutral p-2 rounded-3xl">เข้าสู่ระบบ</legend>
            <form class="fieldset w-xs" action="{{ route('check-emp') }}" method="POST" novalidate>
                @csrf
                <div class="flex flex-col">
                    <label class="label">รหัสพนักงาน</label>
                    <input type="text" class="input validator @error('empcode') input-error @enderror"
                        placeholder="รหัสพนักงาน" name="empcode" id="empcode" autocomplete="off" required
                        oninput="this.classList.remove('input-error'); document.getElementById('error-empCode')?.remove();"
                        value="{{ old('empcode') }}" />
                    @error('empcode')
                        <div id="error-empCode" class="text-error text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <button class="btn btn-neutral mt-4" type="submit">Login</button>
            </form>

        </fieldset>
    </div>
</x-app-layout>
