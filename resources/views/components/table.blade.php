  @props([
      'searchRoute' => '',
  ])
  {{-- Table Nav (div1) --}}
  <div class="navbar rounded-2xl p-3 bg-base-100 shadow-sm  flex flex-col lg:flex-row justify-between ">
      <form class="join" method="GET" action="{{ route($searchRoute) }}">
          <label class="input join-item">
              <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                  <g stroke-linejoin="round" stroke-linecap="round" stroke-width="2.5" fill="none"
                      stroke="currentColor">
                      <circle cx="11" cy="11" r="8"></circle>
                      <path d="m21 21-4.3-4.3"></path>
                  </g>
              </svg>
              <input type="text" placeholder="ค้นหา" name="search" value="{{ $search ?? '' }}" />
              {{-- <input type="text" placeholder="ค้นหา" name="search"  /> --}}
          </label>
          <button class="btn btn-neutral join-item" type="submit">ค้นหา</button>
          {{-- <a href="{{ route($searchRoute) }}" class="btn btn-error join-item text-white">ล้าง</a> --}}
          @if (!empty($search))
              <a href="{{ route($searchRoute) }}" class="btn btn-error join-item text-white">ล้าง</a>
          @endif
      </form>
  </div>
  {{-- ตาราง --}}
  <div class="mt-5">
      <div class="overflow-x-auto">
          <table class="table w-full">
              {{ $tableContent }}
          </table>
      </div>
  </div>
  <div class="mt-6 flex flex-col justify-center lg:flex-row lg:justify-between items-center ">
      <div class="flex flex-row items-center">
          <span>แสดงรายการ</span>
          <form class="px-5" action="{{ route($searchRoute) }}" method="GET">
              <select class="select" name='limit' onchange="this.form.submit()">
                  @php $currentLimit = request('limit', 5); @endphp
                  <option value="5" @selected($currentLimit == 5)>5</option>
                  <option value="10" @selected($currentLimit == 10)>10</option>
                  <option value="25" @selected($currentLimit == 30)>30</option>
                  <option value="50" @selected($currentLimit == 50)>50</option>
                  <option value="100" @selected($currentLimit == 100)>100</option>
              </select>
          </form>
          <span>แถว</span>
      </div>
      {{ $tablePage }}
  </div>
