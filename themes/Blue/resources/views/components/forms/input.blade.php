<div class="bg-gray-100 shadow rounded mt-4 w-full">
    <label for="{{ $name }}" class="text-xs antialiased font-light pl-2 text-gray-800 w-full @isset($disabled) disabled='disabled' readonly='readonly' @endisset @isset($class) {{ $class }} @endisset">
        {{ $label }}
    </label>
    <input
        id="{{ $name }}"
        @isset($type) type="{{ $type }}" @else type="text" @endisset
        name="{{ $name }}"
        class="bg-gray-100 active:bg-gray-200 w-full outline-none text-xs pl-2 mb-1"
        @isset($placeholder) placeholder="{{ $placeholder }}" @endisset
        @isset($value) value="{{ $value }}" @endisset
    >

    @if($errors->has($name))
    <p class="text-red-500 text-xs pl-2 py-1">
        {{ $errors->first($name) }}
    </p>
    @endif
</div>
