@extends('layouts/default')

{{-- Page title --}}
@section('title')
    {{ trans('admin/settings/general.alert_title') }}
    @parent
@stop

@section('header_right')
    <a href="{{ route('settings.index') }}" class="btn btn-primary"> {{ trans('general.back') }}</a>
@stop


{{-- Page content --}}
@section('content')

    <style>
        .checkbox label {
            padding-right: 40px;
        }
    </style>


    <form method="POST" action="{{ route('settings.alerts.save') }}" autocomplete="off" class="form-horizontal" role="form" id="create-form">

    <!-- CSRF Token -->
   {{ csrf_field() }}

    <div class="row">
        <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">


            <div class="panel box box-default">
                <div class="box-header with-border">
                    <h2 class="box-title">
                        <x-icon type="bell"/> {{ trans('admin/settings/general.alerts') }}
                    </h2>
                </div>
                <div class="box-body">

                    <div class="col-md-12">


                        <fieldset name="remote-login" class="bottom-padded">
                            <legend class="highlight">
                                {{ trans('admin/settings/general.legends.general') }}
                            </legend>

                            <!-- Menu Alerts Enabled -->
                            <x-form-row
                                    :item="$setting"
                                    name="show_alerts_in_menu"
                                    type="checkbox"
                                    checkbox_value="1"
                                    :value_text="trans('admin/settings/general.show_alerts_in_menu')"
                            />

                            <!-- Alerts Enabled -->
                            <x-form-row
                                    :item="$setting"
                                    type="checkbox"
                                    name="alerts_enabled"
                                    checkbox_value="1"
                                    :value_text="trans('admin/settings/general.alerts_enabled')"
                            />

                        </fieldset>

                        <fieldset name="remote-login" class="bottom-padded">
                            <legend class="highlight">
                                {{ trans('admin/settings/general.legends.email') }}
                            </legend>

                            <!-- Alert Email -->
                            <x-form-row
                                    :label="trans('admin/settings/general.alert_email')"
                                    :item="$setting"
                                    name="alert_email"
                                    :help_text="trans('admin/settings/general.alert_email_help')"
                                    placeholder="admin@yourcompany.com,it@yourcompany.com"
                            />

                            <!-- Admin CC Email -->
                            <x-form-row
                                    :label="trans('admin/settings/general.admin_cc_email')"
                                    :item="$setting"
                                    name="admin_cc_email"
                                    :help_text="trans('admin/settings/general.admin_cc_email_help')"
                                    placeholder="admin@yourcompany.com"
                            />

                            <!-- Always CC Admins -->
                            <!-- TODO - this doesn't work as expected -->
                            <x-form-row
                                    :item="$setting"
                                    type="radio"
                                    name="admin_cc_always"
                                    value="1"
                                    :value_text="trans('admin/settings/general.admin_cc_always')"
                            />

                            <x-form-row
                                    :item="$setting"
                                    type="radio"
                                    name="admin_cc_always"
                                    value="0"
                                    :value_text="trans('admin/settings/general.admin_cc_when_acceptance_required')"
                            />

                            <div class="form-group">
                                <div class="col-md-9 col-md-offset-3">
                                    <label class="form-control">
                                        <input
                                            type="radio"
                                            name="admin_cc_always"
                                            value="1"
                                            @checked($setting->admin_cc_always == 1)
                                        >
                                        {{ trans('admin/settings/general.admin_cc_always') }}
                                    </label>
                                    <label class="form-control">
                                        <input
                                            type="radio"
                                            name="admin_cc_always"
                                            value="0"
                                            @checked($setting->admin_cc_always == 0)
                                        >
                                        {{ trans('admin/settings/general.admin_cc_when_acceptance_required') }}
                                    </label>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset name="remote-login" class="bottom-padded">
                            <legend class="highlight">
                                {{ trans('admin/settings/general.legends.intervals') }}
                            </legend>


                            <!-- Alert interval -->

                            <x-form-row
                                    :label="trans('admin/settings/general.alert_interval')"
                                    :item="$setting"
                                    name="alert_interval"
                                    type="number"
                                    maxlength="3"
                                    min="0"
                                    max="999"
                                    step="1"
                                    input_div_class="col-md-2 col-sm-6"
                            />


                            <x-form-row
                                    :label="trans('admin/settings/general.alert_inv_threshold')"
                                    :item="$setting"
                                    name="alert_threshold"
                                    type="number"
                                    maxlength="3"
                                    min="0"
                                    max="999"
                                    step="1"
                                    input_div_class="col-md-2 col-sm-6"
                            />

                            <x-form-row
                                    :label="trans('admin/settings/general.audit_interval')"
                                    :item="$setting"
                                    :help_text="trans('admin/settings/general.audit_interval_help')"
                                    :input_group_addon="trans('general.months')"
                                    name="audit_interval"
                                    type="number"
                                    maxlength="3"
                                    min="0"
                                    max="999"
                                    step="1"
                                    input_div_class="col-md-2 col-sm-6 input-group"
                            />

                            <x-form-row
                                    :label="trans('admin/settings/general.audit_warning_days')"
                                    :item="$setting"
                                    :help_text="trans('admin/settings/general.audit_warning_days_help')"
                                    :input_group_addon="trans('general.days')"
                                    name="audit_warning_days"
                                    type="number"
                                    maxlength="3"
                                    min="0"
                                    max="999"
                                    step="1"
                                    input_div_class="col-md-2 col-sm-6 input-group"

                            />

                            <!-- Due for checkin days -->
                            <x-form-row
                                    :label="trans('admin/settings/general.due_checkin_days')"
                                    :item="$setting"
                                    :help_text="trans('admin/settings/general.due_checkin_days_help')"
                                    :input_group_addon="trans('general.days')"
                                    name="due_checkin_days"
                                    type="number"
                                    maxlength="3"
                                    min="0"
                                    max="999"
                                    step="1"
                                    input_div_class="col-md-2 col-sm-6 input-group"
                                    placeholder="14"
                            />

                        </fieldset>

                        </div>


                </div> <!--/.box-body-->
                <div class="box-footer">
                    <div class="text-left col-md-6">
                        <a class="btn btn-link text-left" href="{{ route('settings.index') }}">{{ trans('button.cancel') }}</a>
                    </div>
                    <div class="text-right col-md-6">
                        <button type="submit" class="btn btn-primary"><x-icon type="checkmark" /> {{ trans('general.save') }}</button>
                    </div>

                </div>
            </div> <!-- /box -->
        </div> <!-- /.col-md-8-->
    </div> <!-- /.row-->

    </form>

@stop

