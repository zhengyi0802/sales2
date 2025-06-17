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
      <td>{{ $item['ItemSeq'] }}
      <input type="hidden" name="item[{{ $i }}]['ItemSeq']" value="{{ $item['ItemSeq'] }}"></td>
      <td>{{ $item['ItemName'] }}
      <input type="hidden" name="item[{{ $i }}]['ItemName']" value="{{ $item['ItemName'] }}"></td>
      <td>{{ $item['ItemCount'] }}
      <input type="hidden" name="item[{{ $i }}]['ItemCount']" id="itemcount[{{ $i }}]"
           value="{{ $item['ItemCount'] }}"></td>
      <td>{{ $item['ItemWord'] }}
      <input type="hidden" name="item[{{ $i }}]['ItemWord']" value="{{ $item['ItemWord'] }}"></td>
      <td>
          <input type="number" name="item[{{ $i }}]['ItemPrice'] }]" id = "itemprice[{{ $i }}]"
              value="{{ $item['ItemPrice'] }}"  onchange="calc({{ $i }})">
      </td>
      <td><input type="number" name="item[{{ $i }}]['ItemAmount']"
          id="itemamount[{{ $i }}]" value="{{ $item['ItemAmount'] }}" readonly></td>
      <td>{{ $item['ItemRemark'] }}
      <input type="hidden" name="item[{{ $i }}]['ItemRemark']" value="{{ $item['ItemRemark'] }}">
      <input type="hidden" name="item[{{ $i }}]['ItemTaxType']" value="{{ $item['ItemTaxType'] }}"></td>
    </tr>
@php
  $i++;
@endphp
  @endforeach
</x-adminlte-datatable>
@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)
<script>
  function calc(i)
  {
     ip = 'itemprice[' + i + ']';
     ic = 'itemcount[' + i + ']';
     ia = 'itemamount[' + i +']';
     price = document.getElementById(ip).value;
     count = document.getElementById(ic).value;
     amount = document.getElementById(ia);
     newamount = price * count;
     diff = amount.value - newamount;
     amount.value = newamount;
     sa = document.getElementById('SalesAmount');
     totalamount = sa.value - diff;
     sa.value = totalamount;
  }
</script>
