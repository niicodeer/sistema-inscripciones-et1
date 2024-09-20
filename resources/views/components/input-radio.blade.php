@props(['label', 'id', 'check'=> null])

<div class="flex gap-1 justify-start items-center">
    <label for="{{ $id }}" class="text-[#2D3648] font-normal text-base mb-2 my-auto flex items-center gap-2">
        <input class="border border-gray-300 p-2 rounded h-4 w-4 disabled:bg-gray-300" id={{ $id }}
            type="radio" {{ $check ? "checked" : null }} {{ $attributes }} />
        {{ $label }}
    </label>
    @error($id)
        <p class="text-red-700 text-sm">{{ $message }}</p>
    @enderror
</div>
