@php
$heads = [
    ['label' =>__('newOrders.index'), 'width' => 10],
    __('newOrders.product'),
    __('newOrders.amount'),
    __('newOrders.single_price'),
    __('newOrders.price'),
];
$config = [
    'order' => [[0, 'asc']],
    'columns' => [],
    'language' => [ 'url' => '//cdn.datatables.net/plug-ins/1.13.4/i18n/zh-HANT.json' ],
];
@endphp

<x-adminlte-datatable id="orderlist-table" :heads="$heads" :config="$config" theme="info" head-theme="dark" striped hoverable bordered>
  @foreach($massOrder->items() as $item)
    <tr>
      <td>{{ $item['index'] }}</td>
      <td>{{ $item['product'] }}</td>
      <td>{{ $item['amount'] }}</td>
      <td>{{ $item['single_price'] }}</td>
      <td>{{ $item['price'] }}</td>
    </tr>
  @endforeach
</x-adminlte-datatable>
@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)

