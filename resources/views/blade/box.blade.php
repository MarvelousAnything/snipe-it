@props([
    'item' => null,
    'border_class' => 'default',
    'header_icon' => null,
    'form_route' => null,
])



<div {{ $attributes->merge(['class' => 'col-lg-6 col-lg-offset-3 col-md-10 col-md-offset-1 col-sm-12 col-sm-offset-0']) }}>


        <!-- CSRF Token -->
        {{ csrf_field() }}

        <div class="box box-{{ $border_class }}">

            <!-- .box-header -->
            <div class="box-header with-border">
                <h2 class="box-title">
                    @if ($header_icon)
                        <x-icon type="{{ $header_icon }}" class="box-header-icon" />
                    @endif
                   {{ ($item->id) ? $item->display_name : trans('general.create') }}
                </h2>
            </div>
            <!-- /.box-header -->

            <!-- box-body -->
            <div class="box-body">

                {{ $slot }}

            </div>
            <!-- /.box-body -->

            <div class="box-footer text-right">
                <button type="submit" class="btn btn-success">
                    <x-icon type="checkmark" />
                    {{ trans('general.save') }}
                </button>
            </div>
            <!-- /.box-footer -->

        </div> <!-- /.box-default -->

</div>
