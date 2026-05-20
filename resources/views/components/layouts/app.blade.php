@props([
    'title' => 'title',
])

<!DOCTYPE html>
<html class="h-full bg-gray-100" lang="en" data-theme="sq">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- เพิ่มบรรทัดนี้ เพื่อให้ JS ไฟล์นอกดึง ID ไปใช้ได้ -->
    @auth
        <meta name="user-id" content="{{ Auth::user()->code_emp }}">
    @endauth
    @googlefonts
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>{{ $title }}-{{ config('app.name') }}</title>
</head>

<body class="flex flex-col min-h-screen">
    <div class="sticky top-0 z-50 bg-base-100">
        <div class="navbar bg-primary shadow-sm">
            <div class="navbar-start">
                {{-- Mobile Menu --}}
                <div class="drawer w-10 lg:hidden">
                    <input id="my-drawer-1" type="checkbox" class="drawer-toggle" />
                    <label for="my-drawer-1" class="btn btn-accent">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h8m-8 6h16" />
                        </svg>
                    </label>
                    <div class="drawer-side">
                        <label for="my-drawer-1" aria-label="close sidebar" class="drawer-overlay"></label>

                        <ul class="menu flex flex-col bg-base-200 min-h-full w-80 p-4">
                            <a class="btn text-xl text-gray-50 bg-neutral mx-5"
                                href="{{ route('home') }}">{{ config('app.name') }}</a>
                            @auth
                                <div class="text-center mt-5">
                                    <div class="avatar py-3">
                                        <div
                                            class="ring-primary ring-offset-base-100 w-10 rounded-full ring-2 ring-offset-2">
                                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                </g>
                                                <g id="SVGRepo_iconCarrier">
                                                    <circle cx="12" cy="6" r="4" fill="#1C274C"></circle>
                                                    <path
                                                        d="M20 17.5C20 19.9853 20 22 12 22C4 22 4 19.9853 4 17.5C4 15.0147 7.58172 13 12 13C16.4183 13 20 15.0147 20 17.5Z"
                                                        fill="#1C274C"></path>
                                                </g>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="text-base text-primary">{{ Auth::user()->name_thai_emp }}</div>
                                    {{-- <div class="text-base text-primary">{{ Auth::user()->code_emp }}</div> --}}
                                    <div class="divider my-0"></div>
                                </div>
                            @endauth
                            <li>
                                <a class="btn btn-ghost text-base text-primary mx-1 hover:text-primary"
                                    href="{{ route('home') }}">หน้าหลัก</a>
                            </li>
                            @auth
                                <!-- Sidebar content here -->
                                <div class="flex-1">
                                    <li>
                                        <a class="btn btn-ghost text-base text-primary mx-1 hover:text-primary"
                                            href="{{ route('personal.events') }}">รายการจองของฉัน</a>
                                    </li>
                                    @can('is-admin')
                                        <li class="flex-1">
                                            <a class="btn btn-ghost text-base text-primary mx-1 hover:text-primary"
                                                href="{{ route('admin') }}">Admin Panel</a>
                                        </li>
                                    @endcan
                                    <div class="divider"></div>
                                </div>
                                <div class="flex-none text-center">
                                    <a class="btn bg-red-500 text-gray-100 hover:bg-red-600"
                                        href="{{ route('logout') }}">ออกจากระบบ</a>
                                </div>
                            @endauth
                            {{-- <li><a>Sidebar Item 2</a></li> --}}
                        </ul>
                    </div>
                </div>
                {{-- logo --}}
                <a class="hidden lg:flex btn text-xl text-neutral bg-transparent border-neutral mx-5"
                    href="{{ route('home') }}">{{ config('app.name') }}</a>

                {{-- Menu Desktop --}}
                <a class="btn btn-ghost text-base text-gray-100 mx-1 hover:text-primary hidden lg:flex"
                    href="{{ route('home') }}">หน้าหลัก</a>
                @auth
                    <a class="btn btn-ghost text-base text-gray-100 mx-1 hover:text-primary hidden lg:flex"
                        href="{{ route('personal.events') }}">รายการจองของฉัน</a>
                    <a class="btn btn-secondary text-base  mx-1 hover:text-primary hidden lg:flex"
                        href="{{ route('book') }}">จองห้องประชุม</a>
                @endauth
            </div>

            <div class="navbar-end">
                @guest
                    <a class="btn btn-neutral" href="{{ route('login') }}">เข้าสู่ระบบ</a>
                @endguest
                {{-- User profile on Desktop --}}
                @auth
                    <!-- ไอคอนกระดิ่ง + ตัวเลข Badge -->
                    <a class="flex btn btn-secondary text-base  mx-1 hover:text-primary lg:hidden"
                        href="{{ route('book') }}">จองห้องประชุม</a>
                    <div class="flex mx-5">
                        <div class="dropdown dropdown-end">
                            <!-- 1. ปุ่มกระดิ่ง (ใช้ Indicator ของ DaisyUI จัดการตัวเลขมุมขวาบน) -->
                            <div role="button" tabindex="0" class="btn btn-ghost btn-circle">
                                <div class="indicator">
                                    <!-- แก้ไข typo: fill="soild" เป็น fill="currentColor" -->
                                    <svg class="w-6 h-6 text-yellow-400 fill-current" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                                        </path>
                                    </svg>

                                    @php
                                        $unreadCount = Auth::user()->unreadNotifications->count();
                                    @endphp

                                    <!-- ใช้ badge ของ DaisyUI คู่กับ indicator-item -->
                                    <span id="notification-badge"
                                        class="badge badge-sm badge-error indicator-item text-white {{ $unreadCount === 0 ? 'hidden' : '' }}">
                                        {{ $unreadCount }}
                                    </span>
                                </div>
                            </div>

                            <!-- 2. กล่องรายการแจ้งเตือน (ปรับความกว้างเป็น w-72 เพื่อให้ข้อความไม่บีบเกินไป) -->
                            <ul id="notification-list" tabindex="0"
                                class="dropdown-content menu z-[50] bg-base-100 rounded-box mt-4 w-72 p-2 shadow-lg border border-base-200">

                                @forelse (Auth::user()->notifications()->limit(5)->get() as $notification)
                                    @php
                                        $isUnread = $notification->unread();
                                        // ใช้สีธีมของ DaisyUI: bg-base-200 (ยังไม่อ่าน) / bg-transparent (อ่านแล้ว)
                                        $bgClass = $isUnread ? 'bg-base-200 font-bold' : 'text-base-content/70';
                                    @endphp

                                    <li id="noti-{{ $notification->id }}" class="mb-1">
                                        <!-- DaisyUI บังคับให้ใช้แท็ก <a> ไว้ใน <li> เพื่อให้ Hover effect ทำงาน -->
                                        <a href="{{ $notification->data['url'] }}"
                                            class="{{ $bgClass }} flex items-start gap-3 p-3"
                                            onclick="markAsRead('{{ $notification->id }}')">
                                            <span class="text-lg mt-0.5">🔔</span>
                                            <div class="flex flex-col">
                                                <!-- whitespace-normal ช่วยให้ข้อความยาวๆ ตัดขึ้นบรรทัดใหม่ได้ในเมนู -->
                                                <span
                                                    class="whitespace-normal leading-tight">{{ $notification->data['message'] }}</span>
                                                <!-- เพิ่มเวลาเข้าไปให้ดูสมบูรณ์ขึ้น (Option) -->
                                                <span
                                                    class="text-xs opacity-50 mt-1 font-normal">{{ $notification->created_at->diffForHumans() }}</span>
                                            </div>
                                        </a>
                                    </li>
                                @empty
                                    <li>
                                        <span
                                            class="text-center opacity-50 flex justify-center py-4 cursor-default hover:bg-transparent">
                                            ไม่มีการแจ้งเตือน
                                        </span>
                                    </li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                    <div class="flex gap-2 hidden lg:block">
                        <div class="dropdown dropdown-end">
                            <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                                <div class="w-10 rounded-full">
                                    <svg class="px-2 py-2" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg" stroke="#ffffff">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                        <g id="SVGRepo_iconCarrier">
                                            <circle cx="12" cy="6" r="4" fill="#ffffff"></circle>
                                            <path
                                                d="M20 17.5C20 19.9853 20 22 12 22C4 22 4 19.9853 4 17.5C4 15.0147 7.58172 13 12 13C16.4183 13 20 15.0147 20 17.5Z"
                                                fill="#ffffff"></path>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                            <ul tabindex="-1"
                                class="menu menu-sm dropdown-content bg-base-100 rounded-box z-1 mt-5 w-52 p-2 shadow">
                                <li class="text-base text-primary text-center font-bold">{{ Auth::user()->name_thai_emp }}
                                </li>
                                <div class="divider my-0"></div>
                                @can('is-admin')
                                    <li class="py-1"><a class="text-base text-primary" href="{{ route('admin') }}">Admin
                                            Panel</a></li>
                                @endcan
                                <li class="py-1"><a class="text-base text-gray-100 bg-red-500 hover:bg-red-700"
                                        href="{{ route('logout') }}">ออกจากระบบ</a></li>
                            </ul>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
        {{-- <div class="navbar bg-blue-100 min-h-0 h-15">
            <div class="navbar-start">
                <span
                    class="badge badge-primary badge-xl font-bold text-nowrap p-5 lg:mx-5">{{ $title == config('app.name') ? 'หน้าหลัก' : $title }}</span>
            </div>
            <div class="navbar-end">
                <!-- ไอคอนกระดิ่ง + ตัวเลข Badge -->

            </div>
        </div>
    </div> --}}

        {{-- Content --}}
        <main class="flex-1">
            <div class="mx-auto max-w-7xl px-4 py-2 sm:px-6 lg:px-8">
                {{ $slot }}
            </div>
        </main>

        {{-- Footer --}}
        <footer class="footer sm:footer-horizontal footer-center bg-base-300 text-base-content p-4">
            <aside>
                <p>พัฒนาโดยแผนกสารสนเทศ บมจ.สหกลอิควิปเมนท์ (แม่เมาะ)</p>
            </aside>
        </footer>
        @include('sweetalert::alert')
</body>

</html>
