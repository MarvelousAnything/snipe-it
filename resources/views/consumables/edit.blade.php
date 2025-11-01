@extends('layouts/edit-form', [
    'createText' => trans('admin/consumables/general.create') ,
    'updateText' => trans('admin/consumables/general.update'),
    'helpPosition'  => 'right',
    'helpText' => trans('help.consumables'),
    'formAction' => (isset($item->id)) ? route('consumables.update', ['consumable' => $item->id]) : route('consumables.store'),
    'index_route' => 'consumables.index',
    'container_classes' => 'col-lg-6 col-lg-offset-3 col-md-10 col-md-offset-1 col-sm-12 col-sm-offset-0',
    'options' => [
                'back' => trans('admin/hardware/form.redirect_to_type',['type' => trans('general.previous_page')]),
                'index' => trans('admin/hardware/form.redirect_to_all', ['type' => 'consumables']),
                'item' => trans('admin/hardware/form.redirect_to_type', ['type' => trans('general.consumable')]),
               ]
])
{{-- Page content --}}
@section('inputFields')

@include ('partials.forms.edit.company-select', ['translated_name' => trans('general.company'), 'fieldname' => 'company_id'])

<!-- Name -->
<x-form-row name="name">
    <x-form-label>{{ trans('general.name') }}</x-form-label>
    <x-form-input>
        <x-input.text
                required="true"
                :value="old('name', $item->name)"
        />
    </x-form-input>
</x-form-row>

@include ('partials.forms.edit.category-select', ['translated_name' => trans('general.category'), 'fieldname' => 'category_id', 'required' => 'true', 'category_type' => 'consumable'])
@include ('partials.forms.edit.supplier-select', ['translated_name' => trans('general.supplier'), 'fieldname' => 'supplier_id'])
@include ('partials.forms.edit.manufacturer-select', ['translated_name' => trans('general.manufacturer'), 'fieldname' => 'manufacturer_id'])
@include ('partials.forms.edit.location-select', ['translated_name' => trans('general.location'), 'fieldname' => 'location_id'])

<!-- Model Number -->
<x-form-row name="model_number">
    <x-form-label>{{ trans('general.model_no') }}</x-form-label>
    <x-form-input>
        <x-input.text :value="old('model_number', $item->model_number)"
        />
    </x-form-input>
</x-form-row>

<!-- Item Number -->
<x-form-row name="item_no">
    <x-form-label>{{ trans('admin/consumables/general.item_no') }}</x-form-label>
    <x-form-input>
        <x-input.text :value="old('item_no', $item->item_no)" />
    </x-form-input>
</x-form-row>


<!-- Order Number -->
<x-form-row name="order_number">
    <x-form-label>{{ trans('general.order_number') }}</x-form-label>
    <x-form-input>
        <x-input.text :value="old('order_number', $item->order_number)" />
    </x-form-input>
</x-form-row>

<!--- Purchase Date -->
<x-form-row name="purchase_date">
    <x-form-label>{{ trans('general.purchase_date') }}</x-form-label>
    <x-form-input>
        <x-input.datepicker :value="old('purchase_date', $item->purchase_date_for_datepicker)" />
    </x-form-input>
</x-form-row>

<!-- Purchase Cost -->
<x-form-row name="purchase_cost">
    <x-form-label>{{ trans('general.unit_cost') }}</x-form-label>
    <x-form-input>
        <x-input.text
                type="number"
                :input_group_text="$snipeSettings->default_currency"
                :value="old('purchase_cost', $item->purchase_cost)"
                input_group_addon="left"
                input_max="99999999999999999.000"
                input_min="0"
                input_min="0.00"
                input_step="0.001"
                maxlength="25"
        />
    </x-form-input>
</x-form-row>

<!-- QTY -->
<x-form-row name="qty">
    <x-form-label>{{ trans('general.quantity') }}</x-form-label>
    <x-form-input>
        <x-input.text
                type="number"
                :value="old('qty', $item->qty)"
                  input_min="1"
                required="true"
        />
    </x-form-input>
</x-form-row>

<!-- Minimum QTY -->
<x-form-row name="min_amt">
    <x-form-label>{{ trans('general.min_amt') }}</x-form-label>
    <x-form-input>
        <x-input.text
                type="number"
                :value="old('min_amt', $item->min_amt)"
                input_min="0"
        />
    </x-form-input>
    <x-form-inline-tooltip>
        {{ trans('general.min_amt_help') }}
    </x-form-inline-tooltip>
</x-form-row>


<!-- Notes -->
<x-form-row name="notes">
    <x-form-label>{{ trans('general.notes') }}</x-form-label>
    <x-form-input>
        <x-input.textarea
                :value="old('notes', $item->notes)"
                placeholder="{{ trans('general.placeholders.notes') }}"
        />
    </x-form-input>
</x-form-row>

@include ('partials.forms.edit.image-upload', ['image_path' => app('consumables_upload_path')])

@stop
