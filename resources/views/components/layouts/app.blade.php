@props([
    'title' => 'title',
])

<!DOCTYPE html>
<html class=" bg-gray-100" lang="en" data-theme="sq">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- เพิ่มบรรทัดนี้ เพื่อให้ JS ไฟล์นอกดึง ID ไปใช้ได้ -->
    @auth
        <meta name="user-id" content="{{ Auth::user()->code_emp }}">
    @endauth
    @PwaHead
    @googlefonts
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>{{ $title }}-{{ config('app.name') }}</title>
</head>

<body class="flex flex-col w-full min-h-screen">
    @include('components.layouts.navigation')
    {{-- Content --}}
    <main class="flex-1 overflow-y-auto p-4">
        <div class="mx-auto max-w-full px-4 py-2 sm:px-6 lg:px-8">
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
    @RegisterServiceWorkerScript
    <script>
        window.ReverbConfig = {
            key: '{{ env('REVERB_APP_KEY') }}',
            host: '{{ request()->getHost() }}',
            port: {{ env('REVERB_FRONTEND_PORT', 443) }},
            scheme: '{{ env('REVERB_FRONTEND_SCHEME', 'https') }}'
        };
    </script>
</body>
</html>
