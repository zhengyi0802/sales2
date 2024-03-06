<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://sales2.mdo.tw/vendor/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://sales2.mdo.tw/vendor/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="https://sales2.mdo.tw/vendor/adminlte/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
</head>
<body>
    <p><h3 class="m-0 text-dark">{{ __('inventories.product') }} : {{ $product->model.'('.$product->name.')' ?? '' }}</h3></p>
    @if (auth()->user()->role == App\Enums\UserRole::Stocker || auth()->user()->role == App\Enums\UserRole::Administrator)
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('inventories.create', ['product_id' =>  $product->id]) }}">{{ __('tables.newperiod') }}</a>
            </div>
        </div>
    </div>
    @endif
@php
$heads = [
    __('inventories.serial'),
    __('inventories.start_amount'),
    __('inventories.inbound'),
    __('inventories.outbound'),
    __('inventories.defective'),
    __('inventories.stock'),
    ['label' => __('tables.action'), 'no-export' => true, 'width' => 10],
];
$config = [
    'order' => [[0, 'desc']],
    'columns' => [ null, null, null, null, null, null,  ['orderable' => false]],
    'language' => [ 'url' => '//cdn.datatables.net/plug-ins/1.13.4/i18n/zh-HANT.json' ],
];
@endphp

<x-adminlte-datatable id="inventory-table" :heads="$heads" :config="$config" theme="info" head-theme="dark" striped hoverable bordered>
  @foreach($inventories as $inventory)
    <tr class="{{ $inventory->status ? null : "bg-gray"}}">
      <td>{{ $inventory->serial }}</td>
      <td>{{ $inventory->start_amount }}</td>
      <td>{{ $inventory->inbound }}</td>
      <td>{{ $inventory->outbound }}</td>
      <td>{{ $inventory->defective }}</td>
      <td>{{ $inventory->stock }}</td>
      <td><nobr>
          <x-adminlte-button theme="primary" title="{{ __('tables.edit') }}" icon="fa fa-lg fa-fw fa-pen"
            onClick="window.location='{{ route('inventories.edit', $inventory->id); }}'" >
          </x-adminlte-button>
      </nobr></td>
    </tr>
  @endforeach
</x-adminlte-datatable>
    <script src="https://sales2.mdo.tw/vendor/jquery/jquery.min.js"></script>
    <script src="https://sales2.mdo.tw/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://sales2.mdo.tw/vendor/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <script src="https://sales2.mdo.tw/vendor/adminlte/dist/js/adminlte.min.js"></script>
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" ></script>
    <script src="//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js" ></script>
<script>

    $(() => {
        $('#inventory-table').DataTable( {"order":[[0,"desc"]],"columns":[null,null,null,null,null,null,{"orderable":false}],"language":{"url":"\/\/cdn.datatables.net\/plug-ins\/1.13.4\/i18n\/zh-HANT.json"}} );
    })
</script>
</body>
</html>
