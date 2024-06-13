@props(['label', 'id', 'options'])
<div class="md:max-w-[45%] w-full flex flex-col gap-2 ">
    <label for="{{ $id }}" class="text-[#2D3648] font-semibold text-sm">{{ $label }}</label>
    <select class="border border-gray-300 p-2 rounded h-10 disabled:bg-gray-300" name="{{ $id }}"
        id="{{ $id }}" {{ $attributes }}>
        <option value="" selected disabled>Seleccione una opción</option>
        @foreach (json_decode($options) as $option)
            <option value="{{ $option }}">{{ $option }}</option>
        @endforeach
    </select>
    @error($id)
        <p class="text-red-700 text-sm">{{ $message }}</p>
    @enderror
</div>
