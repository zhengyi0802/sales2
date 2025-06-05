@php
$heads = [
    ['label' =>__('issues.ItemSeq'), 'width' => 10],
    __('issues.ItemName'),
    __('issues.ItemCount'),
    __('issues.ItemWord'),
    __('issues.ItemPrice'),
    __('issues.ItemAmount'),
    __('issues.ItemRemark'),
];
$config = [
    'columns' => [ null, null, null, null, null, null, null],
    'language' => [ 'url' => __('tables.language_url') ],
];
@endphp

<x-adminlte-datatable id="item-table" :heads="$heads" :config="$config" theme="info" head-theme="dark" class="table-sm">
  @foreach($invalid->details()->Items as $item)
    <tr>
      <td>{{ $item->ItemSeq }}</td>
      <td>{{ $item->ItemName }}</td>
      <td>{{ $item->ItemCount }}</td>
      <td>{{ $item->ItemWord }}</td>
      <td>{{ $item->ItemPrice }}</td>
      <td>{{ $item->ItemAmount }}</td>
      <td>{{ $item->ItemRemark }}</td>
    </tr>
  @endforeach
</x-adminlte-datatable>
@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)

