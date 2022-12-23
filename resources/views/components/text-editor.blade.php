@php
    $label = $label ?? null;
    $required = $required ?? false; 
    $multiple = $multiple ?? false; 
    $placeholder = $placeholder ?? ''; 
    $value = old($name, $value ?? ''); 
@endphp

<div class="space-y-2">
    @if($label)
    <label class="font-bold block text-lg {{ $required ? 'label-required' : '' }}" for="{{ $name }}">
        {{ $label }}
    </label>
    @endif
    <div class="border border-gray-300 rounded-lg block w-full p-2.5">
        <textarea 
            id="{{ $name }}"
            name="{{ $name }}"
        >
            {{ $value }}
        </textarea>
    </div>
    @error($name)
        <p class="text-red-600" role="alert">{{ $message }}</p>
    @enderror
</div>

<script>
new FroalaEditor('#{{ $name }}', {
    toolbarInline: true,
    charCounterCount: false,
    placeholderText: '{{ $placeholder }}',
    toolbarVisibleWithoutSelection: true,
    fileUploadURL: '/files/upload',
    fileUploadParams: {
        _token: '{{ csrf_token() }}'
    },
    videoUploadURL: '/files/upload',
    videoUploadParams: {
        _token: '{{ csrf_token() }}'
    },
    filesManagerUploadURL: '/files/upload',
    filesManagerUploadParams: {
        _token: '{{ csrf_token() }}'
    },
    imageUploadURL: '/files/upload',
    imageUploadParams: {
        _token: '{{ csrf_token() }}'
    },
    linkStyles: {
        'fr-green': 'Green',
        'style-links': 'Strong'
    },
});
</script>
