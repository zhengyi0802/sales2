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
@php
  $i = 0;
@endphp
  @foreach($issueData->Items as $item)
    <tr>
      <td>{{ $item['ItemSeq'] }}</td>
      <input type="hidden" name="item[{{ $i }}]['ItemSeq']" value="{{ $item['ItemSeq'] }}">
      <td>{{ $item['ItemName'] }}</td>
      <input type="hidden" name="item[{{ $i }}]['ItemName']" value="{{ $item['ItemName'] }}">
      <td>{{ $item['ItemCount'] }}</td>
      <input type="hidden" name="item[{{ $i }}]['ItemCount']" value="{{ $item['ItemCount'] }}">
      <td>{{ $item['ItemWord'] }}</td>
      <input type="hidden" name="item[{{ $i }}]['ItemWord']" value="{{ $item['ItemWord'] }}">
      <td>{{ $item['ItemPrice'] }}</td>
      <input type="hidden" name="item[{{ $i }}]['ItemPrice']]" value="{{ $item['ItemPrice'] }}">
      <td>{{ $item['ItemAmount'] }}</td>
      <input type="hidden" name="item[{{ $i }}]['ItemAmount']" value="{{ $item['ItemAmount'] }}">
      <td>{{ $item['ItemRemark'] }}</td>
      <input type="hidden" name="item[{{ $i }}]['ItemRemark']" value="{{ $item['ItemRemark'] }}">
      <input type="hidden" name="item[{{ $i }}]['ItemTaxType']" value="{{ $item['ItemTaxType'] }}">
    </tr>
@php
  $i++;
@endphp
  @endforeach
</x-adminlte-datatable>
@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)

