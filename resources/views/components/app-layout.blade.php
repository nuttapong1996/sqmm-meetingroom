@props([
    'title' => 'title',
])

<!DOCTYPE html>
<html class="h-full bg-gray-100" lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @googlefonts
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>{{ $title }}-{{ config('app.name') }}</title>
</head>

<body class="h-full">
    <div class="navbar bg-base-100 shadow-sm" data-theme="aqua">
        <div class="flex-none">
            <div class="drawer">
                <input id="my-drawer-1" type="checkbox" class="drawer-toggle" />
                <div class="drawer-content">
                    <label for="my-drawer-1" class="btn btn-square btn-ghost lg:hidden"> <svg
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            class="inline-block h-5 w-5 stroke-current">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16">
                            </path>
                        </svg></label>
                </div>
                <div class="drawer-side">
                    <label for="my-drawer-1" aria-label="close sidebar" class="drawer-overlay"></label>
                    <ul class="menu bg-base-200 min-h-full w-80 p-4">
                        <!-- Sidebar content here -->
                        <li><a>Sidebar Item 1</a></li>
                        <li><a>Sidebar Item 2</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <a class=" px-3 text-xl" href="/">{{ config('app.name') }}</a>
        <div class="flex-1">
            <div class="flex-12 hidden lg:block">
                <a class="px-5 py-5" href="/">หน้าหลัก</a>
                {{-- <a class="text-xl px-5 py-5 text-gray-100" href="/">หน้าหลัก</a> --}}
            </div>
        </div>
        <div class="flex-none hidden lg:block">
            <a class="px-5 py-5" href="#">Login</a>
        </div>
    </div>
    <main>
        {{ $slot }}
    </main>
</body>

</html>
