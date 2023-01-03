@php
    $label = $label ?? null;
    $required = $required ?? false; 
    $value = old($name, $value ?? '');
    $items = $items ?? [
        'yes' => 'Jā',
        'no' => 'Nē'
    ];
@endphp

<div class="space-y-2">
    @if($label)
        <label class="font-bold block text-lg {{ $required ? 'label-required' : '' }}" for="{{ $name }}">
            {{ $label }}
        </label>
    @endif

    <select
        name="{{ $name }}"
        id="{{ $name }}"
        class="border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full"
    >
        <option></option>

        @foreach($items as $key => $name)
            <option value="{{ $key }}" {{ $value == $key ? 'selected' : '' }}>
                {{ $name }}
            </option>
        @endforeach
    </select>

    @error($name)
        <p class="text-red-600" role="alert">
            {{ $message }}
        </p>
    @enderror
</div>