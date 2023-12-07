@php
$heads = [
    ['label' =>__('massorders.index'), 'width' => 10],
    __('massorders.product'),
    __('massorders.amount'),
    __('massorders.single_price'),
    __('massorders.price'),
];
$config = [
    'order' => [[0, 'asc']],
    'columns' => [],
    'language' => [ 'url' => '//cdn.datatables.net/plug-ins/1.13.4/i18n/zh-HANT.json' ],
];
@endphp

<x-adminlte-datatable id="orderlist-table" :heads="$heads" :config="$config" theme="info" head-theme="dark" striped hoverable bordered>
@php
  $i = 0;
@endphp
  @foreach($massOrder->items() as $item)
    <tr>
      <td>{{ $item['index'] }}</td>
      <td><input type="text" name="products[{{ $i }}][product_id]" value="{{ $item['product_id'] }}" hidden>{{ $item['product'] }}</td>
      <td><input type="number" id="i_amount[{{ $i }}]" name="products[{{ $i }}][amount]" value="{{ $item['amount'] }}"
             onchange="calc({{ $i }})" style="text-align:right"/></td>
      @if (auth()->user()->role <= App\Enums\UserRole::Manager ||
           auth()->user()->role == App\Enums\UserRole::Accounter ||
           auth()->user()->role == App\Enums\UserRole::Operator)
      <td><input type="number" id="i_single_price[{{ $i }}]"  name="products[{{ $i }}][single_price]]" value="{{ $item['single_price'] }}"
             onchange="calc({{ $i }})"  style="text-align:right"/></td>
      @else
      <td><input type="number" id="i_single_price[{{ $i }}]"  name="products[{{ $i }}][single_price]" value="{{ $item['single_price'] }}"
             onchange="calc({{ $i }})"  style="text-align:right" disabled /></td>
      @endif
      <td><input type="number" id="i_price[{{ $i }}]"  name="products[{{ $i }}][price]"
             value="{{ $item['price'] }}" style="text-align:right" disabled/></td>
    </tr>
  @php
    $i++;
  @endphp
  @endforeach
    <tr><td colspan="4" style="text-align:right">{{ __('massorders.price') }}</td>
        <td><input type="number" id="sum"  name="sum"  value="{{ $massOrder->price }}" style="text-align:right" disabled /></td>
    </tr>
    <tr><td colspan="4" style="text-align:right">{{ __('massorders.tax') }}</td>
        <td><input type="number" id="tax"  name="tax"  value="{{ $massOrder->tax }}" style="text-align:right" disabled /></td>
    </tr>
    <tr><td colspan="4" style="text-align:right">{{ __('massorders.total') }}</td>
        <td><input type="number" id="total_price"  name="total"  value="{{ $massOrder->total }}"
              style="text-align:right" disabled /></td>
    </tr>
</x-adminlte-datatable>
@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)
<script>
   function calc(i) {
       sp = 'i_single_price[' + i + ']';
       am = 'i_amount[' + i + ']';
       pr = 'i_price[' + i + ']';
       s = document.getElementById(sp).value;
       a = document.getElementById(am).value;
       val = s * a;
       document.getElementById(pr).value = val;
       sum();
   };

   function sum() {
       i = 0;
       sum = 0;
       pr = 'i_price[' + i + ']';
       dpr = document.getElementById(pr);
       while(dpr != null) {
           sum += Number(dpr.value);
           i++;
           pr = 'i_price[' + i + ']';
           dpr = document.getElementById(pr);
       }
       document.getElementById('sum').value = sum;
       document.getElementById('tax').value = parseInt(sum * 0.05);
       document.getElementById('total_price').value = parseInt(sum * 1.05);
   }
</script>
