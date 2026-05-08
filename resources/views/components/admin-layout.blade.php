<x-app-layout title="{{ $title }}">
    <div class="flex flex-col w-full min-h-screen">
        <div class="text-2xl font-bold text-primary px-4 py-1">Admin Panel</div>
        {{-- top --}}
        <div class="flex-none w-full">
            <ul class="menu menu-horizontal bg-base-200">
                <li class="px-2 py-2"><a class="btn btn-accent border-b-indigo-300 shadow"
                        href="{{ route('admin') }}">Admin Dashboard</a></li>
                <li class="px-2 py-2"><a class="btn btn-accent border-b-indigo-300 shadow"
                        href="{{ route('room.index') }}">จัดการห้องประชุม</a></li>
                <li class="px-2 py-2"><a class="btn btn-accent border-b-indigo-300 shadow">จัดการรายการจอง</a></li>
            </ul>
        </div>
        <div class="text-xl font-black text-primary px-4">{{ $title }}</div>
        <div class="divider  m-1"></div>
        {{-- main --}}
        <div class="flex-1 w-full px-4">
            {{ $AdminContent }}
        </div>
    </div>
</x-app-layout>
