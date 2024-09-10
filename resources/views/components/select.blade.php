@props(['label', 'id', 'options', 'require' => false])

<div class="md:max-w-[45%] w-full flex flex-col gap-2 ">
    <label for="{{ $id }}" class="text-[#2D3648] font-semibold text-sm">{{ $label }}
    @if($require)
        (<span class="text-red-700 text-sm">*</span>)
    @endif
    </label>
    <select class="border border-gray-300 p-2 rounded h-10 disabled:bg-gray-300" name="{{ $id }}"
        id="{{ $id }}" {{ $attributes }}>
        <option value="" disabled {{ old($id) ? '' : 'selected' }}>Seleccione una opción</option>
        @foreach (json_decode($options) as $option)
            <option value="{{ $option }}" {{ old($id) == $option ? 'selected' : '' }}>
                {{ $option }}
            </option>
        @endforeach
    </select>
    @error($id)
        <p class="text-red-700 text-sm">{{ $message }}</p>
    @enderror
</div>
