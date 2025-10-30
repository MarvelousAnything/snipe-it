<!-- form-row blade component -->
@props([
    'help_text' => null,
    'info_tooltip_text' => null,
    'input_div_class' => 'col-md-8',
    'input_class' => null,
    'input_group_addon' => null,
    'input_group_text' => null,
    'input_icon' => null,
    'input_options' => null,
    'input_selected' => null,
    'input_style_override' => false,
    'item' => null,
    'label' => null,
    'min' => null,
    'maxlength' => null,
    'name' => false,
    'placeholder' => null,
    'rows' => null,
    'static_value' => null,
    'type' => 'text',
    'data_endpoint' => false,
    'multiple' => false,
    'required' => false,
    'show_create_new' => false,
])

<div class="form-group">
{{-- <div {{ $attributes->merge(['class' => 'form-group '. ($errors->has($name) ? ' has-error' : '')]) }}> --}}

    <!-- form label -->
    @if (isset($name) && $label)
        <x-form-label  :for="$name" class="{{ $label_class ?? 'col-md-3' }}">{{ $label }}</x-form-label>
    @else
        <div class="{{ $label_class ?? 'col-md-3' }}">{{ $label }}</div>
    @endif


    @php
        $blade_type = in_array($type, ['text', 'email', 'url', 'tel', 'number', 'password']) ? 'text' : $type;
    @endphp

        <div class="{{ $input_div_class }}">

            @if ($slot->isNotEmpty())
                <p class="form-control-static">
                    {{ $slot }}
                </p>
            @else

                <x-dynamic-component
                        :$name
                        :$type
                        :aria-label="$name"
                        :class="$input_class"
                        :component="'input.'.$blade_type"
                        :data-placeholder="$placeholder"
                        :data_endpoint="$data_endpoint"
                        :id="$name"
                        :input_group_addon="$input_group_addon"
                        :input_group_text="$input_group_text"
                        :input_icon="$input_icon"
                        :maxlength="$maxlength"
                        :min="$min"
                        :options="$input_options"
                        :placeholder="$placeholder"
                        :required="($required=='true' || Helper::checkIfRequired($item, $name))"
                        :rows="$rows"
                        :selected="$input_selected"
                        :static_value="$static_value"
                        :style="$input_style_override"
                        :value="old($name, $item->{$name})"
                        :multiple="$multiple"
                />

            @endif

        </div>

    @if ($show_create_new)
        <div class="col-md-1 col-sm-1 text-left">
            @can('create', '\App\Models\\'.ucwords($show_create_new).'::class')
                <a href='{{ route('modal.show', class_basename($show_create_new)) }}' data-toggle="modal"  data-target="#createModal" data-select='supplier_select' class="btn btn-sm btn-primary">{{ trans('button.new') }}</a>
            @endcan
        </div>
    @endif


    @if ($info_tooltip_text)
        <!-- Info Tooltip -->
        <div class="col-md-1 text-left" style="padding-left:0; margin-top: 5px;">
            <x-form-tooltip>
                {{ $info_tooltip_text }}
            </x-form-tooltip>
        </div>
    @endif


    @error($name)
    <div class="col-md-8 col-md-offset-3">
        <span class="alert-msg" aria-hidden="true">
            <x-icon type="x" />
            {{ $message }}
        </span>
    </div>
    @enderror

    @if ($help_text)
        <!-- Help Text -->
        <div class="col-md-8 col-md-offset-3">
            <p class="help-block">
                {!! $help_text !!}
            </p>
        </div>
    @endif




</div>