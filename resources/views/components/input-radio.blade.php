@props(['label', 'id'])

<div class="flex gap-1 justify-start items-center">
    <input
        class="border border-gray-300 p-2 rounded h-4 w-4"
        id={{ $id }}
        name="{{ $id }}"
        type="radio"
        {{ $attributes }}
    />
    <label for="{{ $id }}" class="text-[#2D3648] font-normal text-base">{{ $label }}</label>
    @error($id)
        <p class="text-red-700 text-sm">{{ $message }}</p>
    @enderror
</div>
