<x-app-layout title="{{ $title }}">
    <div class="flex flex-col w-full min-h-screen">
        <div class="text-2xl font-bold text-primary px-4 py-1">{{ $title }}</div>
        {{-- side --}}
        <div class="flex-none w-full">
            <ul class="menu menu-horizontal bg-base-200">
                <li class="px-2"><a class="btn btn-accent border-accent-content" href="{{ route('manage') }}">Admin Dashboard</a></li>
                <li class="px-2"><a class="btn btn-accent border-accent-content" href="{{ route('manage.room') }}">จัดการห้องประชุม</a></li>
                <li class="px-2"><a class="btn btn-accent border-accent-content">จัดการรายการจอง</a></li>
            </ul>
        </div>
        <div class="divider divider-primary m-1"></div>
        {{-- main --}}
        <div class="flex-1 w-full px-4">
            {{ $AdminContent }}
        </div>
    </div>
</x-app-layout>
