@props([
    'selected' => null,
    'forLivewire' => false,
    'data_endpoint' => false,
    'data_placeholder' => false,
    'multiple' => false,
])
<select
        {{ ($multiple == 'true')? ' multiple' : '' }}
        {{ $attributes->class(['select2', 'livewire-select2' => $forLivewire])->style(['width:100%']) }}
        @if($forLivewire) data-livewire-component="{{ $this->getId() }}" @endif
        data-endpoint="{{ $data_endpoint }}"
        data-placeholder="{{ $data_placeholder }}"
>

</select>
