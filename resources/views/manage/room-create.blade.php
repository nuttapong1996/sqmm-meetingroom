<x-admin-layout title="เพิ่มห้องประชุม">
    <x-slot name="AdminContent">
        <div class="flex justify-center mt-3">
            <form class="fieldset" action="" method="POST" enctype="multipart/form-data">

                <fieldset class="fieldset bg-base-200 border-base-300 rounded-box w-lg border p-4">
                    @csrf
                    <x-error-alert></x-error-alert>
                    <legend class="fieldset-legend text-base text-primary">เพิ่มห้องประชุม</legend>

                    <label class="label text-base text-primary">ชื่อห้องประชุม</label>
                    <input type="text" name="roomName" class="input input-primary w-full" placeholder="ห้องประชุม"/>

                    <label class="label text-base text-primary mt-3">สี</label>
                    <input type="color" name="roomColor" value="{{ old('roomColor') }}" class="input input-primary p-2 w-30  cursor-pointer"
                        placeholder="กรุณาเลือกสี" />

                    <label class="label text-base text-primary mt-3">รูปภาพ</label>

                    <input type="file" accept="image/*" name="roomPic" 
                        class="file-input file-input-bordered file-input-primary w-full"
                        placeholder="รูปภาพห้องประชุม" />

                    <button class="btn btn-neutral my-3 w-full" type="submit">ตกลง</button>
            </form>
            </fieldset>
            </form>
        </div>
    </x-slot>
</x-admin-layout>
