 <x-admin-layout title="แดชบอร์ดผู้ดูแล">
     <x-slot name="breadcrumbs">
         {{ Breadcrumbs::render('admin') }}
     </x-slot>
     <x-slot name="AdminContent">
         <div class="flex justify-center">
             <div class="stats mt-3 flex flex-col lg:flex-row w-full  shadow">
                 <div class="stat place-items-center">
                     <div class="stat-title text-base text-gray-600">ห้องประชุมทั้งหมด</div>
                     <div class="stat-value"><a href="{{ route('room.index') }}">{{ $roomTotal }}</a></div>
                     <div class="stat-desc">ห้อง</div>
                 </div>
                 <div class="stat place-items-center">
                     <div class="stat-title text-base text-gray-600">รายการจองทั้งหมด</div>
                     <div class="stat-value text-secondary"><a
                             href="{{ route('admin.meeting.list') }}">{{ $meetingTotal }}</a></div>
                     <div class="stat-desc text-secondary">รายการ</div>
                 </div>
                 <div class="stat place-items-center">
                     <div class="stat-title text-base text-gray-600">คำร้องขอ Zoom คงค้าง</div>
                     <div class="stat-value text-blue-700"><a
                             href="{{ route('zoom.list') }}">{{ $zoomRequestTotal }}</a></div>
                     <div class="stat-desc">รายการ</div>
                 </div>
             </div>
         </div>
     </x-slot>
 </x-admin-layout>
