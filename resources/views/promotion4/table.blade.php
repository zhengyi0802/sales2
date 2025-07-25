@php
$heads = [
    ['label' =>__('promotion4.id'), 'width' => 10],
    __('promotion4.trade_no'),
    __('promotion4.reseller'),
    __('promotion4.name'),
    __('promotion4.phone'),
    __('promotion4.product'),
    __('promotion4.gifts'),
    __('promotion4.payment'),
    __('promotion4.total').'/'.__('promotion4.prepay'),
    __('promotion4.paid').'/'.__('promotion4.staging'),
    __('promotion4.remain').'/'.__('promotion4.stage_price'),
    __('promotion4.flow'),
    __('promotion4.created_at'),
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

<x-adminlte-datatable id="promotion4-table" :heads="$heads" :config="$config" theme="info" head-theme="dark" class="table-sm"
   striped hoverable bordered with-buttons>
  @foreach($promotions as $promotion4)
    @if ($promotion4->ecpayResult != null)
    <tr class="{{ ($promotion4->ecpayResult->rtn_code == 1) ? 'bg-green' : 'bg-light' }}">
    @elseif ($promotion4->ecpayInfo != null)
    <tr class="{{ $promotion4->status ? 'bg-yellow' : 'bg-gray' }}">
    @else
    <tr class="{{ $promotion4->status ? null : 'bg-gray' }}">
    @endif
      <td>{{ $promotion4->id }}</td>
      <td>{{ $promotion4->trade_no }}</td>
      <td>{{ $promotion4->reseller->name }}</td>
      <td>{{ $promotion4->name }}</td>
      @if (auth()->user()->role == App\Enums\UserRole::ShareHolder)
           <td>{{ str_split($promotion4->phone, 5)[0].'****' }}</td>
      @else
           <td>{{ $promotion4->phone }}</td>
      @endif
      <td>{{ $promotion4->product->paytype }}</td>
      <td>
            @foreach (json_decode($promotion4->gifts) as $gift)
                {{ $gift }}<br>
            @endforeach
      </td>
      <td>{{ ($promotion4->payment == 11) ? __('promotion4.payment_third') : __('promotion4.payment_credit') }}</td>
@if ($promotion4->paytype_id == 1)
      <td>{{ __('currencies.NTD').$promotion4->total.__('currencies.ntd_unit') }}</td>
      <td>{{ __('currencies.NTD').$promotion4->paid.__('currencies.ntd_unit') }}</td>
      <td>{{ __('currencies.NTD').$promotion4->remain.__('currencies.ntd_unit') }}</td>
@else
  @if ($promotion4->total > 0)
      <td>{{ __('currencies.NTD').$promotion4->total.__('currencies.ntd_unit') }}</td>
  @else
      <td>------</td>
  @endif
      <td>{{ $promotion4->staging.__('promotion4.staging_unit') }}</td>
      <td>{{ __('currencies.NTD').$promotion4->stage_price.__('currencies.ntd_unit') }}</td>
@endif
      <td>{{ ($promotion4->flow1 > 0) ? trans_choice('promotion4.flows', $promotion4->flow1) : trans_choice('promotion4.flows', $promotion4->flow) }} </td>
      <td>{{ $promotion4->created_at ?? '' }}</td>
      <td><nobr>
          <form name="promotion-delete-form" action="{{ route('promotion4.destroy', $promotion4->id); }}" method="POST">
            @csrf
            @method('DELETE')
              <x-adminlte-button theme="primary" title="{{ __('tables.edit') }}" icon="fa fa-lg fa-fw fa-pen"
                onClick="window.location='{{ route('promotion4.edit', $promotion4->id); }}'" >
              </x-adminlte-button>
              @if ($promotion4->flow < 10)
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

