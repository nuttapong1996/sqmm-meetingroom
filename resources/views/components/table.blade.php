  @props([
      'searchRoute' => '',
      'search' => '',
  ])
  {{-- Table Nav (div1) --}}
  <form class="flex flex-col w-full" method="GET" action="{{ route($searchRoute) }}">
      {{-- Fixed Search Input --}}
      <div class="flex flex-row justify-center w-full lg:justify-start">
          {{-- ช่อง Search --}}
          <div class="join w-full">
              <label class="input w-full join-item" for="search">
                  <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                      <g stroke-linejoin="round" stroke-linecap="round" stroke-width="2.5" fill="none"
                          stroke="currentColor">
                          <circle cx="11" cy="11" r="8"></circle>
                          <path d="m21 21-4.3-4.3"></path>
                      </g>
                  </svg>
                  <input class="input outline-none" type="text" placeholder="ค้นหา" name="search"
                      value="{{ $search ?? '' }}" />
              </label>
              <button class="btn btn-neutral join-item" type="submit">ค้นหา</button>
          </div>
      </div>
      {{-- Dynamic Input --}}
      <div
          class="navbar rounded-box mt-3 bg-base-100 shadow-sm flex flex-col lg:flex-row">
          <div class="navbar-start  w-full justify-center lg:justify-start">
              {{-- ตัวเลือกเรียงลำดับ --}}
              <div class="join w-50 mb-3 mx-2 lg:mb-0">
                  <label class="input join-item w-auto" for="order">เรียงตาม :</label>
                  <select class="select join-item " name="order" id="order" onchange="this.form.submit()">
                      <option value="desc" @selected(request('order') == 'desc')>ล่าสุด</option>
                      <option value="asc" @selected(request('order') == 'asc')>เก่าสุด</option>
                  </select>
              </div>
          </div>
          <div class="navbar-end w-full justify-center lg:justify-end">
              <div class="flex flex-col lg:flex-row">
                  {{ $searchInput }}
              </div>
          </div>
      </div>
  </form>
  @if (!empty($search))
      <span class=" flex flex-row items-center mt-3">
          <i class="mr-2">ผลการค้นหา "{{ $search }}"</i>
          <a href="{{ route('personal.events') }}" class="btn btn-soft btn-error">ล้าง</a>
      </span>
  @endif
  {{-- ตาราง --}}
  <div class="mt-3">
      {{-- <div class="overflow-x-auto"> --}}
      <table class="min-w-full block lg:table">
          {{ $tableContent }}
      </table>
      {{-- </div> --}}
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
