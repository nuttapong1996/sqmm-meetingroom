@props([
    'title' => 'title',
])

<!DOCTYPE html>
<html class="h-full bg-gray-100" lang="en" data-theme="sq">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @googlefonts
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>{{ $title }}-{{ config('app.name') }}</title>
</head>

<body class="flex flex-col min-h-screen">
    <div class="navbar bg-primary shadow-sm">
        <div class="navbar-start">
            {{-- Mobile Menu --}}
            <div class="drawer w-10 lg:hidden">
                <input id="my-drawer-1" type="checkbox" class="drawer-toggle" />
                <label for="my-drawer-1"
                    class="btn btn-accent">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h8m-8 6h16" />
                    </svg>
                </label>
                <div class="drawer-side">
                    <label for="my-drawer-1" aria-label="close sidebar" class="drawer-overlay"></label>

                    <ul class="menu flex flex-col bg-base-200 min-h-full w-80 p-4">
                        @auth
                            <div class="text-center">
                                <div class="avatar py-3">
                                    <div class="ring-primary ring-offset-base-100 w-10 rounded-full ring-2 ring-offset-2">
                                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
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
                                        href="#">รายการจองของฉัน</a>
                                </li>
                                @can('is-admin')
                                    <li class="flex-1">
                                        <a class="btn btn-ghost text-base text-primary mx-1 hover:text-primary"
                                            href="{{ route('manage') }}">การจัดการ</a>
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
            <a class="btn  text-xl text-neutral bg-transparent border-neutral mx-5" href="{{ route('home') }}">{{ config('app.name') }}</a>

            {{-- Menu Desktop --}}
            <a class="btn btn-ghost text-base text-gray-100 mx-1 hover:text-primary hidden lg:flex"
                href="{{ route('home') }}">หน้าหลัก</a>
            @auth
                <a class="btn btn-ghost text-base text-gray-100 mx-1 hover:text-primary hidden lg:flex"
                    href="#">รายการจองของฉัน</a>
            @endauth
        </div>

        <div class="navbar-end">
            @guest
                <a class="btn btn-neutral" href="{{ route('login') }}">เข้าสู่ระบบ</a>
            @endguest
            {{-- User profile on Desktop --}}
            @auth
                <div class="flex gap-2 hidden lg:block">
                    <div class="dropdown dropdown-end">
                        <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                            <div class="w-10 rounded-full">
                                <svg class="px-2 py-2" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                                    stroke="#ffffff">
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
                            <li class="text-base text-primary text-center font-bold">{{ Auth::user()->name_thai_emp }}</li>
                            <div class="divider my-0"></div>
                            @can('is-admin')
                                <li class="py-1"><a class="text-base text-primary">การจัดการ</a></li>
                            @endcan
                            <li class="py-1"><a class="text-base text-gray-100 bg-red-500 hover:bg-red-700"
                                    href="{{ route('logout') }}">ออกจากระบบ</a></li>
                        </ul>
                    </div>
                </div>
            @endauth
        </div>
    </div>

    {{-- Content --}}
    <main class="flex-1">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <div class="flex justify-center items-center">
                {{ $slot }}
            </div>
        </div>
    </main>

    {{-- Footer --}}
    <footer class="footer sm:footer-horizontal footer-center bg-base-300 text-base-content p-4">
        <aside>
            <p>พัฒนาโดยแผนกสารสนเทศ บมจ.สหกลอิควิปเมนท์ (แม่เมาะ)</p>
        </aside>
    </footer>
</body>

</html>
