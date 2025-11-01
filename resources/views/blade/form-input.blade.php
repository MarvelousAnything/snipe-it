@aware(['name'])

@props([
    'class' => 'col-md-8',
])

<?php

// Let's set some sane defaults here for smaller fields
// This uses the form name to determine the appropriate class
switch ($name) {
    case 'qty':
    case 'min_amt':
    case 'seats':
        $class = 'col-md-3';
        break;
    case 'purchase_cost':
    case 'purchase_date':
    case 'termination_date':
    case 'expiration_date':
    case 'start_date':
    case 'end_date':
        $class = 'col-md-5';
        break;
    case 'model_number':
    case 'item_no':
    case 'order_number':
    case 'purchase_order':
            $class = 'col-md-6';
            break;
    default:
        $class = 'col-md-8';
        break;
}

?>
<!-- form-input blade component -->
<div {{ $attributes->merge(['class' => $class]) }}>
    {{ $slot }}
</div>


@error($name)
<div class="col-md-8 col-md-offset-3">
        <span class="alert-msg" aria-hidden="true">
            <x-icon type="x" />
            {{ $message }}
        </span>
</div>


@enderror
