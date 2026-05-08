@props([
    'title' => 'รูปภาพ',
    'name' => 'uploadImage',
])
<label class="label text-base text-primary mt-3">{{ $title }}</label>
<div x-data="{ imageUrl: null, imgPrev: true }">
    <input type="file" accept="image/*" name="{{ $name }}"
        class="file-input file-input-bordered file-input-primary w-full"
        @change="const file = $event.target.files[0];
                                        if (file) {
                                                imageUrl = URL.createObjectURL(file);
                                                imgPrev = false;
                                                 }
                        ">
    <template x-if="imageUrl">
        <div class="flex items-center justify-center w-full px-2 py-2 overflow-hidden">
            <div class="w-20 h-20">
                <img
                    :src="imageUrl">
            </div>
        </div>
    </template>
    <div x-show="imgPrev" class="flex items-center justify-center w-full px-2 py-2 overflow-x-hidden">
        <div class="w-20 h-20 object-cover">
            {{ $imagePrev }}
        </div>
    </div>
</div>
