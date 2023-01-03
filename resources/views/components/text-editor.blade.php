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

    <textarea id="{{ $name }}" name="{{ $name }}">
        {{ $value }}
    </textarea>

    @error($name)
        <p class="text-red-600" role="alert">
            {{ $message }}
        </p>
    @enderror
</div>

<script>
    Jodit.make('#{{ $name }}', {
        controls: {
            classSpan: {
                list: {
                    "style-links": 'Stilizēta saite',
                }
            }
        },
        toolbarSticky: true,
        uploader: {
            url: '/files/upload',
            prepareData: function (formdata) {
                formdata.append("_token", '{{ csrf_token() }}');
            },
            defaultHandlerSuccess: function (data, resp) {
                data.files.forEach(({path, mime}) => {
                    mime.startsWith('image/')
                        ? this.s.insertImage(path)
                        : this.s.insertHTML(`<a href="${path}">${path}</a>`);
                });
            },
        },
        
    });
</script>
