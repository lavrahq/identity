<div class="bg-gray-100 shadow rounded mt-4 w-full">
    <label for="{{ $name }}" class="flex justify-between text-xs antialiased font-light px-2 mt-1 text-gray-800 w-full @isset($disabled) disabled='disabled' readonly='readonly' @endisset @isset($class) {{ $class }} @endisset">
        {{ $label }} @isset($link) <a href="$route" class="text-xs text-blue-600 antialiased font-light">{{ $link }}</a> @endisset
    </label>
    <input
        id="{{ $name }}"
        @isset($type) type="{{ $type }}" @else type="text" @endisset
        name="{{ $name }}"
        class="bg-gray-100 active:bg-gray-200 w-full outline-none text-xs pl-2 mb-1"
        @isset($placeholder) placeholder="{{ $placeholder }}" @endisset
        @isset($value) value="{{ $value }}" @endisset
        @isset($focused) autofocus="autofocus" @endisset
        @isset($disabled) readonly="readonly" @endisset
    >

    @if($errors->has($name))
    <p class="text-red-500 text-xs pl-2 py-1">
        {{ $errors->first($name) }}
    </p>
    @endif
</div>
