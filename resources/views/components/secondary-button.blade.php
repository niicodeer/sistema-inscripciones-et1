@props(['text'])
<a
    {{-- href={{ $href }}  --}}class="text-center p-4 text-base font-bold text-[#202020] max-w-80 w-full rounded-md hover:bg-gray-100 cursor-pointer select-none underline" {{ $attributes }}>
    {{ $text }}
</a>
