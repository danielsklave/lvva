@php
    $label = $label ?? null;
    $value = old($name, $value ?? '');
@endphp

<div class="flex items-center">
    <input 
        id="{{ $name }}"
        name="{{ $name }}"
        {{ $value ? 'checked' : '' }}
        type="checkbox"
        class="w-4 h-4 text-blue-600 rounded border-gray-300 focus:ring-blue-500"
    >

    @if($label)
        <label for="{{ $name }}" class="ml-2 font-medium text-gray-900 dark:text-gray-300">
            {{ $label }}
        </label>
    @endif
</div>

@error($name)
    <p class="text-red-600" role="alert">
        {{ $message }}
    </p>
@enderror