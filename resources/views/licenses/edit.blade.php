@extends('layouts/edit-form', [
    'createText' => trans('admin/licenses/form.create'),
    'updateText' => trans('admin/licenses/form.update'),
    'topSubmit' => true,
    'formAction' => ($item->id) ? route('licenses.update', ['license' => $item->id]) : route('licenses.store'),
     'index_route' => 'licenses.index',
    'container_classes' => 'col-lg-6 col-lg-offset-3 col-md-10 col-md-offset-1 col-sm-12 col-sm-offset-0',
    'options' => [
                'back' => trans('admin/hardware/form.redirect_to_type',['type' => trans('general.previous_page')]),
                'index' => trans('admin/hardware/form.redirect_to_all', ['type' => 'licenses']),
                'item' => trans('admin/hardware/form.redirect_to_type', ['type' => trans('general.license')]),
               ]
])

{{-- Page content --}}
@section('inputFields')

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

@include ('partials.forms.edit.category-select', ['translated_name' => trans('admin/categories/general.category_name'), 'fieldname' => 'category_id', 'required' => 'true', 'category_type' => 'license'])



    <!-- Seats -->
    <x-form-row name="seats">
        <x-form-label>{{ trans('admin/licenses/form.seats') }}</x-form-label>
        <x-form-input>
            <x-input.text
                    type="number"
                    :value="old('seats', $item->seats)"
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


    <!-- Serial-->
@can('viewKeys', $item)
    <div class="form-group {{ $errors->has('serial') ? ' has-error' : '' }}">
        <label for="serial" class="col-md-3 control-label">{{ trans('admin/licenses/form.license_key') }}</label>
        <div class="col-md-7">
            <textarea class="form-control" type="text" name="serial" id="serial" rows="5"{{  (Helper::checkIfRequired($item, 'serial')) ? ' required' : '' }}>{{ old('serial', $item->serial) }}</textarea>
            {!! $errors->first('serial', '<span class="alert-msg" aria-hidden="true"><i class="fas fa-times" aria-hidden="true"></i> :message</span>') !!}
        </div>
    </div>
@endcan

@include ('partials.forms.edit.company-select', ['translated_name' => trans('general.company'), 'fieldname' => 'company_id'])
@include ('partials.forms.edit.manufacturer-select', ['translated_name' => trans('general.manufacturer'), 'fieldname' => 'manufacturer_id',])

<!-- Licensed to name -->
<div class="form-group {{ $errors->has('license_name') ? ' has-error' : '' }}">
    <label for="license_name" class="col-md-3 control-label">{{ trans('admin/licenses/form.to_name') }}</label>
    <div class="col-md-7">
        <input class="form-control" type="text" name="license_name" id="license_name" value="{{ old('license_name', $item->license_name) }}" />
        {!! $errors->first('license_name', '<span class="alert-msg" aria-hidden="true"><i class="fas fa-times" aria-hidden="true"></i> :message</span>') !!}
    </div>
</div>

<!-- Licensed to email -->
<div class="form-group {{ $errors->has('license_email') ? ' has-error' : '' }}">
    <label for="license_email" class="col-md-3 control-label">{{ trans('admin/licenses/form.to_email') }}</label>
    <div class="col-md-7">
        <input class="form-control" type="email" name="license_email" id="license_email" value="{{ old('license_email', $item->license_email) }}" />
        {!! $errors->first('license_email', '<span class="alert-msg" aria-hidden="true"><i class="fas fa-times" aria-hidden="true"></i> :message</span>') !!}
    </div>
</div>

<!-- Reassignable -->
<div class="form-group {{ $errors->has('reassignable') ? ' has-error' : '' }}">
    <div class="col-md-3 control-label">
        <strong>{{ trans('admin/licenses/form.reassignable') }}</strong>
    </div>
    <div class="col-md-7">
        <label class="form-control">
            <input type="checkbox" name="reassignable" value="1" aria-label="reassignable" @checked(old('reassignable', $item->id ? $item->reassignable : '1'))>
        {{ trans('general.yes') }}
        </label>
    </div>
</div>


@include ('partials.forms.edit.supplier-select', ['translated_name' => trans('general.supplier'), 'fieldname' => 'supplier_id'])

    <!-- Order Number -->
    <x-form-row name="order_number">
        <x-form-label>{{ trans('general.order_number') }}</x-form-label>
        <x-form-input>
            <x-input.text :value="old('order_number', $item->order_number)" />
        </x-form-input>
    </x-form-row>

    {{-- @TODO How does this differ from Order #? --}}
    <!-- Purchase Order -->
    <x-form-row name="purchase_order">
        <x-form-label>{{ trans('admin/licenses/form.purchase_order') }}</x-form-label>
        <x-form-input>
            <x-input.text :value="old('purchase_order', $item->purchase_order)" />
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

    <!--- Purchase Date -->
    <x-form-row name="purchase_date">
        <x-form-label>{{ trans('general.purchase_date') }}</x-form-label>
        <x-form-input>
            <x-input.datepicker
                    :value="old('purchase_date', $item->purchase_date_for_datepicker)"
                    input_group_addon="left"/>
        </x-form-input>
    </x-form-row>

<!-- Expiration Date -->
    <x-form-row name="expiration_date">
        <x-form-label>{{ trans('admin/licenses/form.expiration') }}</x-form-label>
        <x-form-input>
            <x-input.datepicker :value="old('expiration_date', $item->expiration_date)" />
        </x-form-input>
    </x-form-row>

<!-- Termination Date -->
    <x-form-row name="termination_date">
        <x-form-label>{{ trans('admin/licenses/form.termination_date') }}</x-form-label>
        <x-form-input>
            <x-input.datepicker :value="old('termination_date', $item->termination_date)" />
        </x-form-input>
    </x-form-row>




@include ('partials.forms.edit.depreciation')

<!-- Maintained -->
<div class="form-group {{ $errors->has('maintained') ? ' has-error' : '' }}">
    <div class="col-md-3 control-label"><strong>{{ trans('admin/licenses/form.maintained') }}</strong></div>
    <div class="col-md-7">
        <label class="form-control">
            <input type="checkbox" name="maintained" value="1" aria-label="maintained" @checked(old('maintained', $item->maintained))>
        {{ trans('general.yes') }}
        </label>
    </div>
</div>

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

@stop
