<a
    href="{{ route('') }}"
    class="w-full text-center rounded py-1 text-xs text-{{ $social->textColor ?: 'white' }} antialiased shadow-lg {{ $class }} bg-{{ $social->bgColor ?: 'black' }}"
    style="{{ $social->style }}"
>
    {{ $social->name }}
</a>
