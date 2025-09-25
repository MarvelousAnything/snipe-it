@props([
    'item' => null,
    'field_name' => null,
    'input_style' => null,
    'required' => false,
    'disabled' => false,
    'checkbox_value' => null,
    'name' => null,
    'label' => null,
    'value_text' => null,
])

<label class="form-control{{ $disabled ? ' form-control--disabled' : ''  }}">
    <input type="checkbox" name="{{ $name }}" aria-label="{{ $name }}" value="{{ $checkbox_value }}" @checked(old($name, $item->$name)) {!! $disabled ? 'class="disabled" disabled' : ''  !!}>
    {{ $value_text ?? $label }}
</label>