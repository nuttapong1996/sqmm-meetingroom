<x-admin-layout title="เพิ่มห้องประชุม">
    <x-slot name="breadcrumbs">
        {{ Breadcrumbs::render('room.create') }}
    </x-slot>
    <x-slot name="AdminContent">
        <div class="flex justify-center mt-3">
            <form class="fieldset w-xs lg:w-lg" action="{{ route('room.store') }}" method="POST"
                enctype="multipart/form-data">
                <fieldset class="fieldset shadow bg-base-100 border-base-300 rounded-box border p-4 w-full ">
                    @csrf
                    <x-error-alert></x-error-alert>
                    <legend class="fieldset-legend text-base text-primary">เพิ่มห้องประชุม</legend>

                    <label class="label text-base text-primary">ชื่อห้องประชุม</label>
                    <input type="text" name="roomName" class="input input-primary w-full" placeholder="ห้องประชุม" value="{{ old('roomName') }}" />

                    <label class="label text-base text-primary mt-3">สี</label>
                    <input type="color" name="roomColor" value="{{ old('roomColor') }}"
                        class="input input-primary p-2 w-30  cursor-pointer" placeholder="กรุณาเลือกสี" />
                    <x-image-upload title="รูปห้องประชุม" name="roomPic">
                        <x-slot name="imagePrev">
                            <img src="{{asset('images/no_image.jpg') }}"
                                alt="" srcset="">
                        </x-slot>
                    </x-image-upload>
                    <button class="btn btn-neutral my-3" type="submit">ตกลง</button>
                </fieldset>
            </form>
        </div>
    </x-slot>
</x-admin-layout>
