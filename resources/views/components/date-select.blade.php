@php
    $label = $label ?? null;
    $required = $required ?? false; 
    $multiple = $multiple ?? false; 
    $placeholder = $placeholder ?? 'Izvēlies datumu'; 
    $value = old($name, ($value ?? null) ? $value->format('d.m.Y') : date('d.m.Y'));
@endphp

<div class="space-y-2">
    @if($label)
    <label class="font-bold block text-lg {{ $required ? 'label-required' : '' }}" for="{{ $name }}">
        {{ $label }}
    </label>
    @endif
    <div class="relative">
        <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
        </div>
        <input
            id="{{ $name }}"
            name="{{ $name }}"
            value="{{ $value }}"
            type="text"
            class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5"
            placeholder="Izvēlies datumu"
        >
    </div>
    @error($name)
        <p class="text-red-600" role="alert">{{ $message }}</p>
    @enderror
</div>

<script>
    Datepicker.locales.lv = lang.lv;
    new Datepicker(document.getElementById('{{ $name }}'), {
        autohide: true,
        format: "dd.mm.yyyy",
        language: 'lv'
    }); 
</script>