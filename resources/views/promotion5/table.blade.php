@php
$heads = [
    ['label' =>__('promotion5.id'), 'width' => 10],
    __('promotion5.trade_no'),
    __('promotion5.reseller'),
    __('promotion5.name'),
    __('promotion5.phone'),
    __('promotion5.product'),
    __('promotion5.gifts'),
    __('promotion5.payment'),
    __('promotion5.total'),
    __('promotion5.paid'),
    __('promotion5.remain'),
    __('promotion5.flow'),
    __('promotion5.created_at'),
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

<x-adminlte-datatable id="promotion5-table" :heads="$heads" :config="$config" theme="info" head-theme="dark" class="table-sm"
   striped hoverable bordered with-buttons>
  @foreach($promotions as $promotion5)
    @if ($promotion5->ecpayResult != null)
    <tr class="{{ ($promotion5->ecpayResult->rtn_code == 1) ? 'bg-green' : 'bg-light' }}">
    @elseif ($promotion5->ecpayInfo != null)
    <tr class="{{ $promotion5->status ? 'bg-yellow' : 'bg-gray' }}">
    @else
    <tr class="{{ $promotion5->status ? null : 'bg-gray' }}">
    @endif
      <td>{{ $promotion5->id }}</td>
      <td>{{ $promotion5->trade_no }}</td>
      <td>{{ $promotion5->reseller->name }}</td>
      <td>{{ $promotion5->name }}</td>
      @if (auth()->user()->role == App\Enums\UserRole::ShareHolder)
           <td>{{ str_split($promotion5->phone, 5)[0].'****' }}</td>
      @else
           <td>{{ $promotion5->phone }}</td>
      @endif
      <td>{{ $promotion5->product->paytype }}</td>
      <td>
            @foreach (json_decode($promotion5->gifts) as $gift)
                {{ $gift }}<br>
            @endforeach
      </td>
      <td>{{ ($promotion5->payment == 11) ? __('promotion5.payment_third') : __('promotion5.payment_credit') }}</td>
      <td>{{ __('currencies.NTD').$promotion5->total.__('currencies.ntd_unit') }}</td>
      <td>{{ __('currencies.NTD').$promotion5->paid.__('currencies.ntd_unit') }}</td>
      <td>{{ __('currencies.NTD').$promotion5->remain.__('currencies.ntd_unit') }}</td>
      <td>{{ ($promotion5->flow1 > 0) ? trans_choice('promotion5.flows', $promotion5->flow1) : trans_choice('promotion5.flows', $promotion5->flow) }} </td>
      <td>{{ $promotion5->created_at ?? '' }}</td>
      <td><nobr>
          <form name="promotion-delete-form" action="{{ route('promotion5.destroy', $promotion5->id); }}" method="POST">
            @csrf
            @method('DELETE')
              <x-adminlte-button theme="primary" title="{{ __('tables.edit') }}" icon="fa fa-lg fa-fw fa-pen"
                onClick="window.location='{{ route('promotion5.edit', $promotion5->id); }}'" >
              </x-adminlte-button>
              @if ($promotion5->flow < 10)
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

