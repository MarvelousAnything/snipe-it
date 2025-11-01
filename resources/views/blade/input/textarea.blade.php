@aware(['name'])
@props([
    'value' => null,
    'rows' => 5,
    'name' => null,
])

<textarea
    {{ $attributes->merge(['class' => 'form-control']) }}
    rows="{{ $rows }}"
    name="{{ $name }}"
>{{ $value }}</textarea>
