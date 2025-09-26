@php
$heads = [
    ['label' =>__('promotion7.id'), 'width' => 10],
    __('promotion7.trade_no'),
    __('promotion7.reseller'),
    __('promotion7.name'),
    __('promotion7.phone'),
    __('promotion7.product'),
    __('promotion7.gifts'),
    __('promotion7.payment'),
    __('promotion7.total'),
    __('promotion7.paid'),
    __('promotion7.remain'),
    __('promotion7.flow'),
    __('promotion7.created_at'),
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

<x-adminlte-datatable id="promotion7-table" :heads="$heads" :config="$config" theme="info" head-theme="dark" class="table-sm"
   striped hoverable bordered with-buttons>
  @foreach($promotions as $promotion7)
    @if ($promotion7->ecpayResult != null)
    <tr class="{{ ($promotion7->ecpayResult->rtn_code == 1) ? 'bg-green' : 'bg-light' }}">
    @elseif ($promotion7->ecpayInfo != null)
    <tr class="{{ $promotion7->status ? 'bg-yellow' : 'bg-gray' }}">
    @else
    <tr class="{{ $promotion7->status ? null : 'bg-gray' }}">
    @endif
      <td>{{ $promotion7->id }}</td>
      <td>{{ $promotion7->trade_no }}</td>
      <td>{{ $promotion7->reseller->name }}</td>
      <td>{{ $promotion7->name }}</td>
      @if (auth()->user()->role == App\Enums\UserRole::ShareHolder)
           <td>{{ str_split($promotion7->phone, 5)[0].'****' }}</td>
      @else
           <td>{{ $promotion7->phone }}</td>
      @endif
      <td>{{ $promotion7->product->paytype }}</td>
      <td>
            @foreach (json_decode($promotion7->gifts) as $gift)
                {{ $gift }}<br>
            @endforeach
      </td>
      <td>{{ ($promotion7->payment == 11) ? __('promotion7.payment_third') : __('promotion7.payment_credit') }}</td>
      <td>{{ __('currencies.NTD').$promotion7->total.__('currencies.ntd_unit') }}</td>
      <td>{{ __('currencies.NTD').$promotion7->paid.__('currencies.ntd_unit') }}</td>
      <td>{{ __('currencies.NTD').$promotion7->remain.__('currencies.ntd_unit') }}</td>
      <td>{{ ($promotion7->flow1 > 0) ? trans_choice('promotion7.flows', $promotion7->flow1) : trans_choice('promotion7.flows', $promotion7->flow) }} </td>
      <td>{{ $promotion7->created_at ?? '' }}</td>
      <td><nobr>
          <form name="promotion-delete-form" action="{{ route('promotion7.destroy', $promotion7->id); }}" method="POST">
            @csrf
            @method('DELETE')
              <x-adminlte-button theme="primary" title="{{ __('tables.edit') }}" icon="fa fa-lg fa-fw fa-pen"
                onClick="window.location='{{ route('promotion7.edit', $promotion7->id); }}'" >
              </x-adminlte-button>
              @if ($promotion7->flow < 10)
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

