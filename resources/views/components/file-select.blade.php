@php
    $label = $label ?? null;
    $required = $required ?? false; 
    $multiple = $multiple ?? false; 
    $value = old($name, $value ?? null);
    $image = $image ?? false;
@endphp

<div class="space-y-2">
    @if($label)
        <label class="font-bold block text-lg {{ $required ? 'label-required' : '' }}" for="{{ $name }}">
            {{ $label }}
        </label>
    @endif

    <input 
        {{ $multiple ? 'multiple' : '' }}
        id="{{ $name }}"
        class="filepond"
        name="{{ $name }}{{ $multiple ? '[]' : '' }}"
        type="file"
        data-allow-reorder="true"
        data-store-as-file="true"
        data-label-idle="Ievelciet vai <span class='filepond--label-action'>izvēlieties</span> @if($image) attēlus līdz 4096 KB @else failus @endif"
    >

    @error($name.($multiple ? '.*' : ''))
        <p class="text-red-600" role="alert">
            {{ $message }}
        </p>
    @enderror
</div>

<script>
    FilePond.create(document.querySelector('#{{ $name }}'), {
        @if($image)
            maxFileSize: "4096KB",
            labelMaxFileSizeExceeded: 'Faila izmērs ir pārāk liels',
            labelMaxFileSize: 'Maksimālais faila izmērs ir {filesize}',
            acceptedFileTypes: ["image/*"],
        @endif
        files: [
            @if($multiple)
                @foreach ($value ?? [] as $file)
                    {
                        source: "{{ url('storage/files/'.$file->file_name) }}",
                    },
                @endforeach
            @elseif($value)
                {
                    source: "{{ url('storage/files/'.$value) }}",
                },
            @endif
        ]
    });
</script>