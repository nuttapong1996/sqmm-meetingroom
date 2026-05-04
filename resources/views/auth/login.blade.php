<x-app-layout title="เข้าสู่ระบบ">
    <fieldset class="fieldset bg-white bg-base-200 border-base-300 rounded-box w-xs border p-4">
        <legend class="fieldset-legend">เข้าสู่ระบบ</legend>
        <form action="{{ route('check-emp') }}" method="POST">
            @csrf
            @if (session('error'))
                <div role="alert" class="alert alert-error mb-5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>
                        {{ session('error')}}
                    </span>
                </div>
            @endif
            <label class="label">รหัสพนักงาน</label>
            <input type="text" class="input" placeholder="รหัสพนักงาน" name="empcode" id="empcode"
                autocomplete="off"  />
            {{-- <p class="validator-hint hidden">กรุณากรอกรหัสพนักงาน</p> --}}

            {{-- <label class="label">Password</label>
        <input type="password" class="input" placeholder="Password" /> --}}

            <button class="btn btn-neutral mt-4" type="submit">Login</button>
        </form>

    </fieldset>
</x-app-layout>
