@props([
    'item' => null,
    'update_route' => null,
    'create_route' => null,
])

<form class="form-horizontal" id="create-form" method="post" action="{{ ($item->id) ? route($update_route, $item->id) : route($create_route) }}" autocomplete="off" enctype="multipart/form-data">

  @if ($item->id)
      {{ method_field('PUT') }}
  @endif

  {{ $slot  }}

</form>
