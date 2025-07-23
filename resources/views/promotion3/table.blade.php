@php
$heads = [
    ['label' =>__('promotion3.id'), 'width' => 10],
    __('promotion3.trade_no'),
    __('promotion3.reseller'),
    __('promotion3.name'),
    __('promotion3.phone'),
    __('promotion3.product'),
    __('promotion3.payment'),
    __('promotion3.total'),
    __('promotion3.paid'),
    __('promotion3.remain'),
    __('promotion3.flow'),
    __('promotion3.created_at'),
    ['label' => __('tables.action'), 'no-export' => true, 'width' => 10],
];
$config = [
    'order' => [[0, 'desc']],
    'columns' => [null, null, null, null, null, null, null, null, null, null, null, null, ['orderable' => false]],
    'language' => [ 'url' => __('tables.language_url') ],
];
@endphp
<div class="row">
    <div class="col-md-4">{{ __('tables.table-bgcolor') }}</div>
    <div class="col-md-4" style="background-color:green;color:white;">{{ __('tables.bg-green') }}</div>
    <div class="col-md-4" style="background-color:yellow">{{ __('tables.bg-yellow') }}</div>
</div>

<x-adminlte-datatable id="promotion3-table" :heads="$heads" :config="$config" theme="info" head-theme="dark" class="table-sm"
   striped hoverable bordered with-buttons>
  @foreach($promotions as $promotion3)
    @if ($promotion3->ecpayResult != null)
    <tr class="{{ ($promotion3->ecpayResult->rtn_code == 1) ? 'bg-green' : 'bg-light' }}">
    @elseif ($promotion3->ecpayInfo != null)
    <tr class="{{ $promotion3->status ? 'bg-yellow' : 'bg-gray' }}">
    @else
    <tr class="{{ $promotion3->status ? null : 'bg-gray' }}">
    @endif
      <td>{{ $promotion3->id }}</td>
      <td>{{ $promotion3->trade_no }}</td>
      <td>{{ $promotion3->reseller->name }}</td>
      <td>{{ $promotion3->name }}</td>
      @if (auth()->user()->role == App\Enums\UserRole::ShareHolder)
           <td>{{ str_split($promotion3->phone, 5)[0].'****' }}</td>
      @else
           <td>{{ $promotion3->phone }}</td>
      @endif
      <td>{{ $promotion3->product->paytype }}</td>
      <td>{{ ($promotion3->payment == 11) ? __('promotion3.payment_third') : __('promotion3.payment_credit') }}</td>
@if ($promotion3->paytype_id == 1)
      <td>{{ __('currencies.NTD').$promotion3->total.__('currencies.ntd_unit') }}</td>
      <td>{{ __('currencies.NTD').$promotion3->paid.__('currencies.ntd_unit') }}</td>
      <td>{{ __('currencies.NTD').$promotion3->remain.__('currencies.ntd_unit') }}</td>
@else
  @if ($promotion3->total > 0)
      <td>{{ __('currencies.NTD').$promotion3->total.__('currencies.ntd_unit') }}</td>
  @else
      <td>------</td>
  @endif
      <td>{{ $promotion3->staging.__('promotion3.staging_unit') }}</td>
      <td>{{ __('currencies.NTD').$promotion3->stage_price.__('currencies.ntd_unit') }}</td>
@endif
      <td>{{ ($promotion3->flow1 > 0) ? trans_choice('promotion3.flows', $promotion3->flow1) : trans_choice('promotion3.flows', $promotion3->flow) }} </td>
      <td>{{ $promotion3->created_at ?? '' }}</td>
      <td><nobr>
          <form name="promotion-delete-form" action="{{ route('promotion3.destroy', $promotion3->id); }}" method="POST">
            @csrf
            @method('DELETE')
              <x-adminlte-button theme="primary" title="{{ __('tables.edit') }}" icon="fa fa-lg fa-fw fa-pen"
                onClick="window.location='{{ route('promotion3.edit', $promotion3->id); }}'" >
              </x-adminlte-button>
              @if ($promotion3->flow < 10)
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

