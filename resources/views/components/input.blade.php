@php
    $label = $label ?? null;
    $required = $required ?? false; 
    $multiple = $multiple ?? false;
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
        autocomplete="off"
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $name }}"
        class="border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
        placeholder="{{ $placeholder }}"
        value="{{ $value }}"
    >
    @error($name)
        <p class="text-red-600" role="alert">{{ $message }}</p>
    @enderror
</div>