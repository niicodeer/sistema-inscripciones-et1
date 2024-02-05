@props(['label', 'id', 'wireModel'])

<div class="md:max-w-[45%] w-full flex flex-col gap-2">
    <label for="{{ $id }}" class="text-[#2D3648] font-semibold text-sm">{{ $label }}</label>
    <input
        class="border border-gray-300 p-2 rounded h-10"
        id={{ $id }}
        name={{ $id }}
        {{ $attributes }}
    />
    @error($id)
        <p class="text-red-700 text-sm">{{ $message }}</p>
    @enderror
</div>
