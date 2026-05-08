<x-admin-layout title="แก้ไขห้องประชุม {{ $room->name }}">
    <x-slot name="AdminContent">
        <div class="flex justify-center mt-3">
            <form class="fieldset w-xs lg:w-lg" action="{{ route('room.update' ,$room->id) }}" method="POST" enctype="multipart/form-data">
                <fieldset class="fieldset shadow bg-base-100 border-base-300 rounded-box border p-4 w-full ">
                    @csrf
                    @method('PUT')
                    <x-error-alert></x-error-alert>
                    <legend class="fieldset-legend text-base text-primary">แก้ไขห้องประชุม</legend>
                    <label class="label text-base text-primary">ชื่อห้องประชุม</label>
                    <input type="text" disabled name="roomName" class="input text-base text-primary w-full"
                        placeholder="ห้องประชุม" value="{{ $room->name }}" />

                    <label class="label text-base text-primary mt-3">สี</label>
                    <input type="color" name="roomColor" value="{{ $room->color }}"
                        class="input input-primary p-2 w-30  cursor-pointer" placeholder="กรุณาเลือกสี" />

                    <x-image-upload title="รูปห้องประชุม" name="roomPic">
                        <x-slot name="imagePrev">
                            <img src="{{ !empty($room['pic']) ? asset('storage/' . $room['pic']) : asset('images/no_image.jpg') }}"
                                alt="" srcset="">
                        </x-slot>
                    </x-image-upload>
                    <button class="btn btn-neutral my-3" type="submit">ตกลง</button>
                </fieldset>
            </form>
        </div>
    </x-slot>
</x-admin-layout>
