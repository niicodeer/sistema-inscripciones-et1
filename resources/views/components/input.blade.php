@props(['label', 'id', 'require'=> false])

<div class="md:max-w-[45%] w-full flex flex-col gap-2">
    <label for="{{ $id }}" class="text-[#2D3648] font-semibold text-sm ">{{ $label }}
        @if($require)
            (<span class="text-red-700 text-sm">*</span>)
        @endif
    </label>
    <input
        class="border p-2 rounded h-10 disabled:bg-gray-200 @error($id) border-red-700 @else border-gray-300 @enderror"
        id={{ $id }}
        name={{ $id }}
        {{ $attributes }}
    />
    @error($id)
        <p class="text-red-700 text-sm">{{ $message }}</p>
    @enderror
</div>
