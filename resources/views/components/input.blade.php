@props(['label', 'id', 'wireModel', 'require'=> false])

<div class="md:max-w-[45%] w-full flex flex-col gap-2">
    <label for="{{ $id }}" class="text-[#2D3648] font-semibold text-sm ">{{ $label }}
        @if($require)
            (<span class="text-red-700 text-sm">*</span>)
        @endif
    </label>
    <input
        class="border border-gray-300 p-2 rounded h-10 disabled:bg-gray-200"
        id={{ $id }}
        name={{ $id }}
        {{ $attributes }}
    />
    @error($id)
        <p class="text-red-700 text-sm">{{ $message }}</p>
    @enderror
</div>
