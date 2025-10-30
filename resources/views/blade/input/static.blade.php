@props([
'static_value' => false,
])

<p class="form-control-static">
    {{ $slot ?? $static_value }}
</p>