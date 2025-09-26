@php
$heads = [
    ['label' =>__('promotion8.id'), 'width' => 10],
    __('promotion8.trade_no'),
    __('promotion8.reseller'),
    __('promotion8.name'),
    __('promotion8.phone'),
    __('promotion8.product'),
    __('promotion8.gifts'),
    __('promotion8.payment'),
    __('promotion8.total'),
    __('promotion8.paid'),
    __('promotion8.remain'),
    __('promotion8.flow'),
    __('promotion8.created_at'),
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

<x-adminlte-datatable id="promotion8-table" :heads="$heads" :config="$config" theme="info" head-theme="dark" class="table-sm"
   striped hoverable bordered with-buttons>
  @foreach($promotions as $promotion8)
    @if ($promotion8->ecpayResult != null)
    <tr class="{{ ($promotion8->ecpayResult->rtn_code == 1) ? 'bg-green' : 'bg-light' }}">
    @elseif ($promotion8->ecpayInfo != null)
    <tr class="{{ $promotion8->status ? 'bg-yellow' : 'bg-gray' }}">
    @else
    <tr class="{{ $promotion8->status ? null : 'bg-gray' }}">
    @endif
      <td>{{ $promotion8->id }}</td>
      <td>{{ $promotion8->trade_no }}</td>
      <td>{{ $promotion8->reseller->name }}</td>
      <td>{{ $promotion8->name }}</td>
      @if (auth()->user()->role == App\Enums\UserRole::ShareHolder)
           <td>{{ str_split($promotion8->phone, 5)[0].'****' }}</td>
      @else
           <td>{{ $promotion8->phone }}</td>
      @endif
      <td>{{ $promotion8->product->paytype }}</td>
      <td>
            @foreach (json_decode($promotion8->gifts) as $gift)
                {{ $gift }}<br>
            @endforeach
      </td>
      <td>{{ ($promotion8->payment == 11) ? __('promotion8.payment_third') : __('promotion8.payment_credit') }}</td>
      <td>{{ __('currencies.NTD').$promotion8->total.__('currencies.ntd_unit') }}</td>
      <td>{{ __('currencies.NTD').$promotion8->paid.__('currencies.ntd_unit') }}</td>
      <td>{{ __('currencies.NTD').$promotion8->remain.__('currencies.ntd_unit') }}</td>
      <td>{{ ($promotion8->flow1 > 0) ? trans_choice('promotion8.flows', $promotion8->flow1) : trans_choice('promotion8.flows', $promotion8->flow) }} </td>
      <td>{{ $promotion8->created_at ?? '' }}</td>
      <td><nobr>
          <form name="promotion-delete-form" action="{{ route('promotion8.destroy', $promotion8->id); }}" method="POST">
            @csrf
            @method('DELETE')
              <x-adminlte-button theme="primary" title="{{ __('tables.edit') }}" icon="fa fa-lg fa-fw fa-pen"
                onClick="window.location='{{ route('promotion8.edit', $promotion8->id); }}'" >
              </x-adminlte-button>
              @if ($promotion8->flow < 10)
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

