<!-- form-row blade component -->
@props([
    'checkbox_value' => null,
    'disabled' => false,
    'div_style' => null,
    'error_offset_class' => 'col-md-7 col-md-offset-3',
    'errors',
    'help_text' => null,
    'info_tooltip_text' => null,
    'input_class' => null,
    'input_div_class' => 'col-md-8 col-sm-12',
    'input_group_addon' => null,
    'input_style' => null,
    'item' => null,
    'label' => null,
    'label_class' => 'col-md-3 col-sm-12 col-xs-12',
    'label_style' => null,
    'max' => null,
    'maxlength' => 191,
    'min' => null,
    'minlength' => null,
    'name' => null,
    'placeholder' => null,
    'step' => null,
    'type' => 'text',
    'value' => null,
    'value_text' => null,
])

<div {{ $attributes->merge(['class' => 'form-group']) }}>

    @if (isset($label))
    <x-form-label
            :for="$name"
            :style="$label_style ?? null"
            class="{{ $label_class }}"
    >
        {{ $label }}
    </x-form-label>
    @else
       @php
          $input_div_class = $input_div_class . ' ' . $error_offset_class;
       @endphp
    @endif
    

    <div {{ $attributes->merge(['class' => $input_div_class, 'style' => $div_style]) }}>

        @php
            $blade_type = in_array($type, ['text', 'email', 'url', 'tel', 'number', 'password']) ? 'text' : $type;
        @endphp

        <x-dynamic-component
                :$checkbox_value
                :$disabled
                :$input_group_addon
                :$input_style
                :$item
                :$max
                :$maxlength
                :$min
                :$minlength
                :$name
                :$placeholder
                :$step
                :$type
                :$value_text
                :aria-label="$name"
                :class="$input_class"
                :component="'input.'.$blade_type"
                :id="$name"
                :required="Helper::checkIfRequired($item, $name)"
                :value="old($name, $item->{$name})"
        />
    </div>


        @if ($info_tooltip_text)
            <!-- Info Tooltip -->
            <div class="col-md-1 text-left" style="padding-left:0; margin-top: 5px;">
                <x-input.info-tooltip>
                    {{ $info_tooltip_text }}
                </x-input.info-tooltip>
            </div>
        @endif


        @error($name)
        <!-- Form Error -->
            <div {{ $attributes->merge(['class' => $error_offset_class]) }}>
                <span class="alert-msg" role="alert">
                    <i class="fas fa-times" aria-hidden="true"></i>
                    {{ $message }}
                </span>
            </div>
        @enderror

        @if ($help_text)
        <!-- Help Text -->
            <div {{ $attributes->merge(['class' => $error_offset_class]) }}>
                <p class="help-block">
                    {!! $help_text !!}
                </p>
            </div>
        @endif

</div>
