@php
$heads = [
    ['label' =>__('promotion6.id'), 'width' => 10],
    __('promotion6.trade_no'),
    __('promotion6.reseller'),
    __('promotion6.name'),
    __('promotion6.phone'),
    __('promotion6.product'),
    __('promotion6.gifts'),
    __('promotion6.payment'),
    __('promotion6.total'),
    __('promotion6.paid'),
    __('promotion6.remain'),
    __('promotion6.flow'),
    __('promotion6.created_at'),
    ['label' => __('tables.action'), 'no-export' => true, 'width' => 10],
];
$config = [
    'order' => [[0, 'desc']],
    'columns' => [null, null, null, null, null, null, null, null, null, null, null, null, null, ['orderable' => false]],
    'language' => [ 'url' => __('tables.language_url') ],
];
@endphp
<div class="row">
    <div class="col-md-4">{{ __('tables.table-bgcolor') }}</div>
    <div class="col-md-4" style="background-color:green;color:white;">{{ __('tables.bg-green') }}</div>
    <div class="col-md-4" style="background-color:yellow">{{ __('tables.bg-yellow') }}</div>
</div>

<x-adminlte-datatable id="promotion6-table" :heads="$heads" :config="$config" theme="info" head-theme="dark" class="table-sm"
   striped hoverable bordered with-buttons>
  @foreach($promotions as $promotion6)
    @if ($promotion6->ecpayResult != null)
    <tr class="{{ ($promotion6->ecpayResult->rtn_code == 1) ? 'bg-green' : 'bg-light' }}">
    @elseif ($promotion6->ecpayInfo != null)
    <tr class="{{ $promotion6->status ? 'bg-yellow' : 'bg-gray' }}">
    @else
    <tr class="{{ $promotion6->status ? null : 'bg-gray' }}">
    @endif
      <td>{{ $promotion6->id }}</td>
      <td>{{ $promotion6->trade_no }}</td>
      <td>{{ $promotion6->reseller->name }}</td>
      <td>{{ $promotion6->name }}</td>
      @if (auth()->user()->role == App\Enums\UserRole::ShareHolder)
           <td>{{ str_split($promotion6->phone, 5)[0].'****' }}</td>
      @else
           <td>{{ $promotion6->phone }}</td>
      @endif
      <td>{{ $promotion6->product->paytype }}</td>
      <td>
            @foreach (json_decode($promotion6->gifts) as $gift)
                {{ $gift }}<br>
            @endforeach
      </td>
      <td>{{ ($promotion6->payment == 11) ? __('promotion6.payment_third') : __('promotion6.payment_credit') }}</td>
      <td>{{ __('currencies.NTD').$promotion6->total.__('currencies.ntd_unit') }}</td>
      <td>{{ __('currencies.NTD').$promotion6->paid.__('currencies.ntd_unit') }}</td>
      <td>{{ __('currencies.NTD').$promotion6->remain.__('currencies.ntd_unit') }}</td>
      <td>{{ ($promotion6->flow1 > 0) ? trans_choice('promotion6.flows', $promotion6->flow1) : trans_choice('promotion6.flows', $promotion6->flow) }} </td>
      <td>{{ $promotion6->created_at ?? '' }}</td>
      <td><nobr>
          <form name="promotion-delete-form" action="{{ route('promotion6.destroy', $promotion6->id); }}" method="POST">
            @csrf
            @method('DELETE')
              <x-adminlte-button theme="primary" title="{{ __('tables.edit') }}" icon="fa fa-lg fa-fw fa-pen"
                onClick="window.location='{{ route('promotion6.edit', $promotion6->id); }}'" >
              </x-adminlte-button>
              @if ($promotion6->flow < 10)
              <x-adminlte-button theme="danger" title="{{ __('tables.delete') }}" icon="fa fa-lg fa-fw fa-trash"
                type="submit" onclick="return confirm('{{ __('tables.confirm_delete') }}');">
              </x-adminlte-button>
              @endif
            </form>
      </nobr></td>
    </tr>
  @endforeach
</x-adminlte-datatable>
@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)

