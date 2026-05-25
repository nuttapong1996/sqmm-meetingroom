@props([
    'title' => 'title',
])
<x-app-layout title="{{ $title }}">
    <div class="flex flex-col w-full min-h-screen">
        {{-- <div class="text-2xl font-bold text-primary px-4 py-1">Admin Panel</div> --}}
        {{-- top --}}
        <div class="flex-none w-full">
            <ul class="menu menu-horizontal bg-base-200">
                <li class="px-2 py-2">
                    <a class="btn border-b-indigo-300 shadow {{ request()->routeIs('admin') ? 'bg-orange-400 text-white hover:bg-orange-600 border-b-orange-400' : 'btn-accent' }}"
                        href="{{ route('admin') }}">
                        Dashboard
                    </a>
                </li>
                <li class="px-2 py-2">
                    <a class="btn btn-accent border-b-indigo-300 shadow {{ request()->routeIs('room.index') ? 'bg-orange-400 text-white hover:bg-orange-600 border-b-orange-400' : 'btn-accent' }}"
                        href="{{ route('room.index') }}">ห้องประชุม</a>
                </li>
                <li class="px-2 py-2"><a
                        class="btn btn-accent border-b-indigo-300 shadow {{ request()->routeIs('admin.meeting.list') ? 'bg-orange-400 text-white hover:bg-orange-600 border-b-orange-400' : 'btn-accent' }}"
                        href="{{ route('admin.meeting.list') }}">รายการจอง</a></li>
                <li class="px-2 py-2"><a
                        class="btn btn-accent border-b-indigo-300 shadow {{ request()->routeIs('admin.zoom.list') ? 'bg-orange-400 text-white hover:bg-orange-600 border-b-orange-400' : 'btn-accent' }}"
                        href="{{ route('admin.zoom.list') }}">รายการร้องขอ Zoom</a></li>
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
