@extends('layouts/default')

{{-- Page title --}}
@section('title')
  @if ($item->id)
    {{ trans('admin/maintenances/form.update') }}
  @else
    {{ trans('admin/maintenances/form.create') }}
  @endif
  @parent
@stop


@section('header_right')
<a href="{{ URL::previous() }}" class="btn btn-primary pull-right">
  {{ trans('general.back') }}</a>
@stop


{{-- Page content --}}
@section('content')

<div class="row">


  <!-- Inititate form component -->
  <x-form :$item update_route="maintenances.update" create_route="maintenances.store">

      <!-- Start box component -->
      <x-box :$item header_icon="maintenances">

        <!-- This is an existing maintenance -->
        @if ($item->id)

          @if ($item->asset)
            <x-form-row :label="trans('general.asset')" name="asset">
                {{ $item->asset->display_name }}
            </x-form-row>

              @if ($item->asset->company)
                  <x-form-row :label="trans('general.company')" name="company">
                      {{ $item->asset->company->display_name }}
                  </x-form-row>

              @endif


              @if ($item->asset->location)
                <x-form-row :label="trans('general.location')" name="location">
                  {{ $item->asset->location->display_name }}
                </x-form-row>
              @endif
          @endif

        @endif

          <!-- Name -->
          <x-form-row
                  :label="trans('general.name')"
                  :$item
                  name="name"
          />

         @if (!$item->id)
             <x-form-row
                        :$item
                        :data_placeholder="trans('general.select_asset')"
                        :label="trans('general.assets')"
                        :selected="$item->id ? $item->asset()->pluck('id')->toArray() : old('selected_assets')"
                        data_endpoint="hardware"
                        input_class="js-data-ajax select2"
                        name="selected_assets[]"
                        required="true"
                        type="select2-ajax"
                        multiple="true"
                />
         @endif


        <x-form-row
                :label="trans('admin/maintenances/form.asset_maintenance_type')"
                :$item
                name="asset_maintenance_type"
                type="select"
                input_style_override="width:100%;"
                :input_options="$maintenanceType"
                :input_selected="old('asset_maintenance_type', $item->asset_maintenance_type)"
                includeEmpty="true"
                data-placeholder="{{ trans('admin/maintenances/form.select_type')}}"
        />



        <!--- Start Date -->
        <x-form-row
                :label="trans('admin/maintenances/form.start_date')"
                :$item
                name="start_date"
                type="datepicker"
                input_div_class="col-md-5"
        />


        <!--- Completion Date -->
        <x-form-row
                :label="trans('admin/maintenances/form.completion_date')"
                :$item
                name="completion_date"
                type="datepicker"
                input_div_class="col-md-5"
        />

        <!-- URL -->
        <x-form-row
                :label="trans('general.url')"
                :$item
                name="url"
                type="url"
                input_icon="link"
                input_group_addon="left"
                placeholder="https://example.com"
        />

          <x-form-row
                  :$item
                  :data_placeholder="trans('general.select_supplier')"
                  :label="trans('general.supplier')"
                  :selected="$item->id ? $item->supplier()->pluck('id')->toArray() : old('suppliers')"
                  data_endpoint="suppliers"
                  input_div_class="col-md-7"
                  input_class="js-data-ajax select2"
                  name="supplier_id"
                  type="select2-ajax"
                  show_create_new="supplier"
          />


        <!-- Warranty -->
        <div class="form-group">
          <div class="col-sm-offset-3 col-sm-9">
              <label class="form-control">
                <input type="checkbox" value="1" name="is_warranty" id="is_warranty" {{ old('is_warranty', $item->is_warranty) == '1' ? ' checked="checked"' : '' }}>
                {{ trans('admin/maintenances/form.is_warranty') }}
              </label>
          </div>
        </div>


        <!-- Asset Maintenance Cost -->
        <x-form-row
                :label="trans('admin/maintenances/form.cost')"
                :$item
                name="cost"
                type="number"
                input_div_class="col-md-5"
                input_min="0"
                :input_group_text="$snipeSettings->default_currency"
                input_group_addon="left"
                maxlength="25"
                input_max="99999999999999999.000"
                input_min="0.00"
                input_step="0.001"
        />


        @include ('partials.forms.edit.image-upload', ['image_path' => app('maintenances_path')])

        <!-- Notes -->
        <x-form-row
                :label="trans('general.notes')"
                :$item
                name="notes"
                type="textarea"
                placeholder="{{ trans('general.placeholders.notes') }}"
        />


        <!-- End box component -->
  </x-box>
    <!-- Start form component -->
</x-form>

</div>
@stop
