<x-app-layout title='ระบบจองห้องประชุม'>
    <div class="flex flex-col">
        <div class="flex-1">
            <div class="mx-auto max-w-6xl px-4 py-8">
                <h2 class="text-2xl font-bold mb-4">สถานะห้องประชุม ณ ปัจจุบัน</h2>
                <div id="room-status-container" data-status="{{ route('api.rooms.status') }}" class="grid grid-cols-1 md:grid-cols-3 gap-6">
                </div>
            </div>
        </div>
        <div class="flex-1">
            <div class="mx-auto max-w-6xl px-2 py-5 lg:px-8">
                <div class="bg-white p-2 rounded-xl shadow-md">
                    <div class="w-full" id="meetCalendar" data-url="{{ route('meetings.events') }}"></div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
