@props([
    'item' => null,
    'field_name' => null,
    'input_style' => null,
    'required' => false,
    'disabled' => false,
    'name' => null,
    'label' => null,
    'value_text' => null,
])

<label class="form-control{{ $disabled ? ' form-control--disabled' : ''  }}">
    <input type="radio" name="{{ $name }}" aria-label="{{ $name }}" @checked(old($name)) {!! $disabled ? 'class="disabled" disabled' : ''  !!}>
    {{ $value_text ?? $label }}
</label>