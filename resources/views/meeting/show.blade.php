<x-app-layout title="{{ $meeting->title }}">
    <div class="flex flex-col justify-center items-center">
        <div class="mx-auto w-full max-w-2xl p-4">
            <div class="flex flex-col border border-gray-300 rounded-box p-6 mt-3 ">
                <h2 class="text-xl font-bold">รายละเอียดการประชุม</h2>
                {{-- <div class="flex flex-row justify-between items-center">
                    <h2 class="text-xl font-bold">รายละเอียดการประชุม</h2>
                    <a class="badge p-5 bg-red-500 text-gray-50 cursor-pointer hover:bg-red-600"
                        onclick="cancelMeeting(this.form)">
                        <svg class="w-5 h-5 text-gray-50 fill-current" viewBox="0 0 32 32" version="1.1"
                            xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <title>cancel</title>
                                <path
                                    d="M10.771 8.518c-1.144 0.215-2.83 2.171-2.086 2.915l4.573 4.571-4.573 4.571c-0.915 0.915 1.829 3.656 2.744 2.742l4.573-4.571 4.573 4.571c0.915 0.915 3.658-1.829 2.744-2.742l-4.573-4.571 4.573-4.571c0.915-0.915-1.829-3.656-2.744-2.742l-4.573 4.571-4.573-4.571c-0.173-0.171-0.394-0.223-0.657-0.173v0zM16 1c-8.285 0-15 6.716-15 15s6.715 15 15 15 15-6.716 15-15-6.715-15-15-15zM16 4.75c6.213 0 11.25 5.037 11.25 11.25s-5.037 11.25-11.25 11.25-11.25-5.037-11.25-11.25c0.001-6.213 5.037-11.25 11.25-11.25z">
                                </path>
                            </g>
                        </svg>
                        ยกเลิก
                    </a>
                </div> --}}
                <ul class="list">
                    <li class="mt-3">
                        <h2 class="text-xl">หัวข้อ : {{ $meeting->title }}</h2>
                    </li>
                    <li class="flex items-center mt-3">
                        <svg class="w-6 h-6 stroke-gray-500 mr-3" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path
                                    d="M12 7V12H15M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            </g>
                        </svg>
                        <span> {{ $meeting->start_time->thaidate('d/m/Y') }},
                            {{ $meeting->start_time->thaidate('H:i') }} น. -
                            {{ $meeting->end_time->thaidate('d/m/Y') }}, {{ $meeting->end_time->thaidate('H:i') }}
                            น.</span>
                    </li>
                    <li class="flex items-center mt-3">
                        <svg class="w-6 h-6 stroke-gray-500 mr-3" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path
                                    d="M12 21C15.5 17.4 19 14.1764 19 10.2C19 6.22355 15.866 3 12 3C8.13401 3 5 6.22355 5 10.2C5 14.1764 8.5 17.4 12 21Z"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                </path>
                                <path
                                    d="M12 13C13.6569 13 15 11.6569 15 10C15 8.34315 13.6569 7 12 7C10.3431 7 9 8.34315 9 10C9 11.6569 10.3431 13 12 13Z"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                </path>
                            </g>
                        </svg>
                        <span> ห้องประชุม {{ $meeting->room->name }}</span>
                    </li>
                    <li class="flex items-center mt-3">
                        <svg class="w-5 h-5 fill-gray-500 mr-3" viewBox="0 0 1000 1000"
                            xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path
                                    d="M500 70q-117 0-217 59-97 57-154 154-59 100-59 217t59 217q57 97 154 154 100 59 217 59t217-59q97-57 154-154 59-100 59-217t-59-217q-57-97-154-154-100-59-217-59zm0 108q79 0 148 36t114.5 99.5T819 455h-69q-12 0-25.5-6.5T704 432l-86-114q-7-10-17.5-10T583 318L417 540q-7 9-17.5 9t-17.5-9l-46-61q-7-10-20.5-17t-24.5-7H181q11-78 56.5-141.5T352 214t148-36zm0 644q-79 0-148-36t-114.5-99.5T181 545h69q12 0 25.5 7t20.5 16l86 115q7 9 17.5 9t17.5-9l166-222q7-10 17.5-10t17.5 10l46 61q7 9 20.5 16t24.5 7h110q-11 78-56.5 141.5T648 786t-148 36z">
                                </path>
                            </g>
                        </svg>
                        <span>สถานะ :
                            @if ($meeting->room_status_id == 2)
                                <span class="badge bg-red-500 text-white">ยกเลิก</span>
                            @elseif (now() > $meeting->end_time)
                                <span class="badge bg-green-200">เสร็จสิ้น</span>
                            @elseif (now() >= $meeting->start_time && now() <= $meeting->end_time)
                                <span class="badge bg-green-400">กำลังใช้</span>
                            @elseif ($meeting->room_status_id == 1 && now() < $meeting->start_time)
                                <span class="badge bg-yellow-500">จองแล้ว</span>
                            @else
                                {{ $meeting->status->name ?? 'ไม่ระบุสถานะ' }}
                            @endif
                        </span>
                    </li>
                    <li class="flex items-center mt-3">
                        <svg class="w-5 h-5 mr-3" fill="#ffffff" viewBox="-3.2 -3.2 38.40 38.40" version="1.1"
                            xmlns="http://www.w3.org/2000/svg" stroke="#ffffff">
                            <g id="SVGRepo_bgCarrier" stroke-width="0">
                                <rect x="-3.2" y="-3.2" width="38.40" height="38.40" rx="11.52" fill="#0B5CFF"
                                    strokewidth="0"></rect>
                            </g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <title>zoom</title>
                                <path
                                    d="M19.283 17.4c-0.367 0.374-0.879 0.606-1.444 0.606-1.117 0-2.023-0.906-2.023-2.023s0.906-2.023 2.023-2.023c0.929 0 1.712 0.626 1.949 1.479l0.003 0.014c0.045 0.159 0.071 0.341 0.071 0.53 0 0.552-0.221 1.052-0.579 1.417l0-0zM15.471 13.586c-0.648 0.615-1.052 1.483-1.052 2.446 0 1.861 1.509 3.37 3.37 3.37s3.37-1.509 3.37-3.37c0-1.54-1.033-2.838-2.444-3.241l-0.024-0.006c-0.27-0.078-0.581-0.123-0.902-0.123-0.899 0-1.716 0.352-2.32 0.925l0.002-0.001zM28.296 12.601c-0.802 0.001-1.522 0.352-2.016 0.909l-0.002 0.003c-0.496-0.562-1.219-0.915-2.023-0.915-0.563 0-1.086 0.173-1.519 0.468l0.009-0.006c-0.316-0.278-0.73-0.451-1.184-0.462l-0.002-0v6.742l0.337-0.016c0.544-0.014 0.981-0.451 0.995-0.993l0-0.001 0.016-0.337v-2.361l0.017-0.337c0-0.001 0-0.002 0-0.003 0-0.245 0.061-0.477 0.169-0.679l-0.004 0.008c0.238-0.405 0.671-0.672 1.166-0.672s0.928 0.267 1.162 0.664l0.003 0.006c0.103 0.196 0.164 0.428 0.165 0.675v0l0.017 0.339v2.361l0.016 0.336c0.022 0.54 0.454 0.972 0.991 0.995l0.002 0 0.337 0.016v-3.708l0.015-0.337c0-0.001 0-0.002 0-0.003 0-0.247 0.062-0.48 0.171-0.683l-0.004 0.008c0.238-0.403 0.67-0.669 1.165-0.669 0.496 0 0.929 0.268 1.164 0.666l0.003 0.006c0.102 0.195 0.162 0.427 0.162 0.673 0 0.001 0 0.001 0 0.002v-0l0.019 0.337v2.361l0.016 0.336c0.020 0.541 0.454 0.975 0.993 0.995l0.002 0 0.337 0.016v-4.045c-0.001-1.488-1.208-2.694-2.697-2.694-0.001 0-0.002 0-0.003 0h0zM12.206 17.4c-0.37 0.393-0.894 0.638-1.475 0.638-1.117 0-2.023-0.906-2.023-2.023s0.906-2.023 2.023-2.023c0.924 0 1.703 0.619 1.945 1.465l0.004 0.014c0.047 0.163 0.075 0.351 0.075 0.544 0 0.536-0.209 1.024-0.549 1.386l0.001-0.001zM10.78 12.6h-0.005c-1.86 0.001-3.367 1.509-3.367 3.368s1.508 3.368 3.368 3.368 3.368-1.508 3.368-3.368c0-1.86-1.507-3.367-3.366-3.368h-0zM6.734 18.008l-0.337-0.015h-3.035l4.044-4.045-0.016-0.337c-0.013-0.544-0.451-0.982-0.994-0.995l-0.001-0-0.337-0.016h-5.052l0.018 0.337c0.026 0.538 0.455 0.967 0.99 0.995l0.002 0 0.337 0.016h3.037l-4.049 4.045 0.017 0.336c0.019 0.541 0.453 0.975 0.992 0.995l0.002 0 0.337 0.016h5.056l-0.018-0.337c-0.024-0.539-0.455-0.969-0.991-0.993l-0.002-0z">
                                </path>
                            </g>
                        </svg>
                        <span>Zoom :
                            {!! $meeting->zoom_use == 1 ? 'ใช้' : 'ไม่ใช้' !!}
                        </span>
                    </li>
                    <li class="flex items-center mt-3">
                        <svg class="w-5 h-5 mr-3 text-gray-500 fill-current" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path
                                    d="M12 6.25C11.3096 6.25 10.75 6.80964 10.75 7.5C10.75 8.19036 11.3096 8.75 12 8.75C12.6904 8.75 13.25 8.19036 13.25 7.5C13.25 6.80964 12.6904 6.25 12 6.25Z">
                                </path>
                                <path
                                    d="M9.75 15.5C9.75 14.2574 10.7574 13.25 12 13.25C13.2426 13.25 14.25 14.2574 14.25 15.5C14.25 16.7426 13.2426 17.75 12 17.75C10.7574 17.75 9.75 16.7426 9.75 15.5Z">
                                </path>
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M4 10C4 6.22876 4 4.34315 5.17157 3.17157C6.34315 2 8.22876 2 12 2C15.7712 2 17.6569 2 18.8284 3.17157C20 4.34315 20 6.22876 20 10V14C20 17.7712 20 19.6569 18.8284 20.8284C17.6569 22 15.7712 22 12 22C8.22876 22 6.34315 22 5.17157 20.8284C4 19.6569 4 17.7712 4 14V10ZM9.25 7.5C9.25 5.98122 10.4812 4.75 12 4.75C13.5188 4.75 14.75 5.98122 14.75 7.5C14.75 9.01878 13.5188 10.25 12 10.25C10.4812 10.25 9.25 9.01878 9.25 7.5ZM12 11.75C9.92893 11.75 8.25 13.4289 8.25 15.5C8.25 17.5711 9.92893 19.25 12 19.25C14.0711 19.25 15.75 17.5711 15.75 15.5C15.75 13.4289 14.0711 11.75 12 11.75Z">
                                </path>
                            </g>
                        </svg>
                        <span>
                            เครื่องเสียง : {{ $meeting->audio_system == 1 ? 'ใช้' : 'ไม่ใช้' }}
                        </span>
                    </li>
                    <li class="flex items-center mt-3">
                        <svg class="w-5 h-5 mr-3 text-gray-500 fill-current" version="1.0" id="Layer_1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                            viewBox="0 0 64 64" enable-background="new 0 0 64 64" xml:space="preserve">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path
                                    d="M60,0H4C1.789,0,0,1.789,0,4v40c0,2.211,1.789,4,4,4h8v15c0,0.404,0.243,0.77,0.617,0.924 C12.741,63.976,12.871,64,13,64c0.26,0,0.516-0.102,0.707-0.293L29.414,48H60c2.211,0,4-1.789,4-4V4C64,1.789,62.211,0,60,0z M15,14 h16c0.553,0,1,0.447,1,1s-0.447,1-1,1H15c-0.553,0-1-0.447-1-1S14.447,14,15,14z M45,34H15c-0.553,0-1-0.447-1-1s0.447-1,1-1h30 c0.553,0,1,0.447,1,1S45.553,34,45,34z M14,27c0-0.553,0.447-1,1-1h24c0.553,0,1,0.447,1,1s-0.447,1-1,1H15 C14.447,28,14,27.553,14,27z M49,22H15c-0.553,0-1-0.447-1-1s0.447-1,1-1h34c0.553,0,1,0.447,1,1S49.553,22,49,22z">
                                </path>
                            </g>
                        </svg>
                        <span>
                            อื่นๆ : {{ $meeting->other_equipment !== null ? $meeting->other_equipment : '-' }}
                        </span>
                    </li>
                </ul>
            </div>
            @if ($meeting->zoom_use == 1)
                <div class="flex flex-row justify-center items-center border border-gray-300 rounded-box p-6 mt-3">
                    <svg class="w-10 h-10 mr-3" fill="#ffffff" viewBox="-3.2 -3.2 38.40 38.40" version="1.1"
                        xmlns="http://www.w3.org/2000/svg" stroke="#ffffff">
                        <g id="SVGRepo_bgCarrier" stroke-width="0">
                            <rect x="-3.2" y="-3.2" width="38.40" height="38.40" rx="11.52" fill="#0B5CFF"
                                strokewidth="0"></rect>
                        </g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <title>zoom</title>
                            <path
                                d="M19.283 17.4c-0.367 0.374-0.879 0.606-1.444 0.606-1.117 0-2.023-0.906-2.023-2.023s0.906-2.023 2.023-2.023c0.929 0 1.712 0.626 1.949 1.479l0.003 0.014c0.045 0.159 0.071 0.341 0.071 0.53 0 0.552-0.221 1.052-0.579 1.417l0-0zM15.471 13.586c-0.648 0.615-1.052 1.483-1.052 2.446 0 1.861 1.509 3.37 3.37 3.37s3.37-1.509 3.37-3.37c0-1.54-1.033-2.838-2.444-3.241l-0.024-0.006c-0.27-0.078-0.581-0.123-0.902-0.123-0.899 0-1.716 0.352-2.32 0.925l0.002-0.001zM28.296 12.601c-0.802 0.001-1.522 0.352-2.016 0.909l-0.002 0.003c-0.496-0.562-1.219-0.915-2.023-0.915-0.563 0-1.086 0.173-1.519 0.468l0.009-0.006c-0.316-0.278-0.73-0.451-1.184-0.462l-0.002-0v6.742l0.337-0.016c0.544-0.014 0.981-0.451 0.995-0.993l0-0.001 0.016-0.337v-2.361l0.017-0.337c0-0.001 0-0.002 0-0.003 0-0.245 0.061-0.477 0.169-0.679l-0.004 0.008c0.238-0.405 0.671-0.672 1.166-0.672s0.928 0.267 1.162 0.664l0.003 0.006c0.103 0.196 0.164 0.428 0.165 0.675v0l0.017 0.339v2.361l0.016 0.336c0.022 0.54 0.454 0.972 0.991 0.995l0.002 0 0.337 0.016v-3.708l0.015-0.337c0-0.001 0-0.002 0-0.003 0-0.247 0.062-0.48 0.171-0.683l-0.004 0.008c0.238-0.403 0.67-0.669 1.165-0.669 0.496 0 0.929 0.268 1.164 0.666l0.003 0.006c0.102 0.195 0.162 0.427 0.162 0.673 0 0.001 0 0.001 0 0.002v-0l0.019 0.337v2.361l0.016 0.336c0.020 0.541 0.454 0.975 0.993 0.995l0.002 0 0.337 0.016v-4.045c-0.001-1.488-1.208-2.694-2.697-2.694-0.001 0-0.002 0-0.003 0h0zM12.206 17.4c-0.37 0.393-0.894 0.638-1.475 0.638-1.117 0-2.023-0.906-2.023-2.023s0.906-2.023 2.023-2.023c0.924 0 1.703 0.619 1.945 1.465l0.004 0.014c0.047 0.163 0.075 0.351 0.075 0.544 0 0.536-0.209 1.024-0.549 1.386l0.001-0.001zM10.78 12.6h-0.005c-1.86 0.001-3.367 1.509-3.367 3.368s1.508 3.368 3.368 3.368 3.368-1.508 3.368-3.368c0-1.86-1.507-3.367-3.366-3.368h-0zM6.734 18.008l-0.337-0.015h-3.035l4.044-4.045-0.016-0.337c-0.013-0.544-0.451-0.982-0.994-0.995l-0.001-0-0.337-0.016h-5.052l0.018 0.337c0.026 0.538 0.455 0.967 0.99 0.995l0.002 0 0.337 0.016h3.037l-4.049 4.045 0.017 0.336c0.019 0.541 0.453 0.975 0.992 0.995l0.002 0 0.337 0.016h5.056l-0.018-0.337c-0.024-0.539-0.455-0.969-0.991-0.993l-0.002-0z">
                            </path>
                        </g>
                    </svg>
                    <a class="cursor-pointer underline underline-offset-2 "
                        onclick="showLinkZoom('{{ $meeting->link_zoom }}', '{{ $meeting->title }}' , '{{ $meeting->zoom_id }}' , '{{ $meeting->passcode_zoom }}')">
                        ดูลิงก์ Zoom
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
