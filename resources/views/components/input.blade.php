@php
    $label = $label ?? null;
    $required = $required ?? false; 
    $type = $type ?? 'text';
    $placeholder = $placeholder ?? false;
    $value = old($name, $value ?? '');
@endphp

<div class="space-y-2">
    @if($label)
        <label class="font-bold block text-lg {{ $required ? 'label-required' : '' }}" for="{{ $name }}">
            {{ $label }}
        </label>
    @endif

    <input
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $name }}"
        class="border border-gray-300 @error($name) border-red-500 @enderror rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full"
        placeholder="{{ $placeholder }}"
        value="{{ $value }}"
    >

    @error($name)
        <p class="text-red-600" role="alert">
            {{ $message }}
        </p>
    @enderror
</div>