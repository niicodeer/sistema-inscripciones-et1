@props(['label', 'id', 'check'=> null])

<div class="w-full flex gap-2 justify-start items-center">
    <label for="{{ $id }}" class="text-[#2D3648] font-normal text-base">
        <input class="border border-gray-300 p-2 rounded h-4 w-4" id={{ $id }} type="checkbox" {{ $check ? "checked" : null }} {{ $attributes }} />
        {{ $label }}</label>
    @error($id)
        <p class="text-red-700 text-sm">{{ $message }}</p>
    @enderror
</div>
