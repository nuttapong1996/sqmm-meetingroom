 <x-admin-layout title="Admin Dashboard">
     <x-slot name="AdminContent">
         <div class="flex justify-center">
             <div class="stats mt-3 flex flex-col lg:flex-row w-full  shadow">
                 <div class="stat place-items-center">
                     <div class="stat-title">ห้องประชุมทั้งหมด</div>
                     <div class="stat-value">{{ $roomTotal }}</div>
                     <div class="stat-desc">ห้อง</div>
                 </div>

                 <div class="stat place-items-center">
                     <div class="stat-title">รายการจองทั้งหมด</div>
                     <div class="stat-value text-secondary">4,200</div>
                     <div class="stat-desc text-secondary">รายการ</div>
                 </div>

                 {{-- <div class="stat place-items-center">
                     <div class="stat-title">New Registers</div>
                     <div class="stat-value">1,200</div>
                     <div class="stat-desc">↘︎ 90 (14%)</div>
                 </div> --}}
             </div>
         </div>
     </x-slot>
 </x-admin-layout>
