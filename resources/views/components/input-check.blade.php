@props(['label', 'id', 'wireModel'])

<div class="w-full flex gap-2 justify-start items-center">
    <input
        class="border border-gray-300 p-2 rounded h-5 w-5"
        id={{ $id }}
        type="checkbox"
        {{ $attributes }}
    />
    <label for="{{ $id }}" class="text-[#2D3648] font-normal text-base">{{ $label }}</label>
    @error($id)
        <p class="text-red-700 text-sm">{{ $message }}</p>
    @enderror
</div>
