@php
$heads = [
    ['label' =>__('promotion1.id'), 'width' => 10],
    __('promotion1.reseller'),
    __('promotion1.name'),
    __('promotion1.phone'),
    __('promotion1.product'),
    __('promotion1.gifts'),
    __('promotion1.payment'),
    __('promotion1.total').'/'.__('promotion1.prepay'),
    __('promotion1.paid').'/'.__('promotion1.staging'),
    __('promotion1.remain').'/'.__('promotion1.stage_price'),
    __('promotion1.flow'),
    __('promotion1.created_at'),
    ['label' => __('tables.action'), 'no-export' => true, 'width' => 10],
];
$config = [
    'order' => [[0, 'desc']],
    'columns' => [null, null, null, null, null, null, null, null, null, null, null, null, ['orderable' => false]],
    'language' => [ 'url' => __('tables.language_url') ],
];
@endphp

<x-adminlte-datatable id="promotion1-table" :heads="$heads" :config="$config" theme="info" head-theme="dark" class="table-sm"
   striped hoverable bordered with-buttons>
  @foreach($promotions as $promotion1)
    @if ($promotion1->ecpayResult != null)
    <tr class="{{ $promotion1->status ? 'bg-green' : 'bg-gray' }}">
    @elseif ($promotion1->ecpayInfo != null)
    <tr class="{{ $promotion1->status ? 'bg-yellow' : 'bg-gray' }}">
    @else
    <tr class="{{ $promotion1->status ? null : 'bg-gray' }}">
    @endif
      <td>{{ $promotion1->id }}</td>
      <td>{{ $promotion1->reseller->name }}</td>
      <td>{{ $promotion1->name }}</td>
      @if (auth()->user()->role == App\Enums\UserRole::ShareHolder)
           <td>{{ str_split($promotion1->phone, 5)[0].'****' }}</td>
      @else
           <td>{{ $promotion1->phone }}</td>
      @endif
      <td>{{ $promotion1->product->paytype }}</td>
      <td>
            @foreach (json_decode($promotion1->gifts) as $gift)
              @if ($gift == 'gift1')
                  {{ __('promotion1.gift1') }}
              @elseif ($gift == 'gift2')
                  {{ __('promotion1.gift2') }}
              @elseif ($gift == 'gift3')
                  {{ __('promotion1.gift3') }}
              @elseif ($gift == 'gift4')
                  {{ __('promotion1.gift4') }}
              @elseif ($gift == 'gift5')
                  {{ __('promotion1.gift5') }}
              @elseif ($gift == 'gift6')
                  {{ __('promotion1.gift6') }}
              @elseif ($gift == 'gift7')
                  {{ __('promotion1.gift7') }}
              @endif
            @endforeach
      </td>
      <td>{{ ($promotion1->payment == 11) ? __('promotion1.payment_third') : __('promotion1.payment_credit') }}</td>
@if ($promotion1->paytype_id == 4)
      <td>{{ __('currencies.NTD').$promotion1->total.__('currencies.ntd_unit') }}</td>
      <td>{{ __('currencies.NTD').$promotion1->paid.__('currencies.ntd_unit') }}</td>
      <td>{{ __('currencies.NTD').$promotion1->remain.__('currencies.ntd_unit') }}</td>
@elseif($promotion1->paytype_id == 6)
      <td>{{ __('currencies.NTD').$promotion1->prepay_total.__('currencies.ntd_unit') }}</td>
      <td>{{ __('currencies.NTD').$promotion1->paid }}</td>
      <td>{{ __('currencies.NTD').$promotion1->remain.__('currencies.ntd_unit') }}</td>
@elseif($promotion1->paytype_id == 5 || $promotion1->paytype_id == 7)
      <td>{{ __('currencies.NTD').$promotion1->prepay_total.__('currencies.ntd_unit') }}</td>
      <td>{{ $promotion1->staging.__('promotion1.staging') }}</td>
      <td>{{ __('currencies.NTD').$promotion1->stage_price.__('currencies.ntd_unit') }}</td>
@endif
      <td>{{ ($promotion1->flow1 > 0) ? trans_choice('promotion1.flows', $promotion1->flow1) : trans_choice('promotion1.flows', $promotion1->flow) }} </td>
      <td>{{ $promotion1->created_at ?? '' }}</td>
      <td><nobr>
          <form name="promotion-delete-form" action="{{ route('promotion1.destroy', $promotion1->id); }}" method="POST">
            @csrf
            @method('DELETE')
              <x-adminlte-button theme="primary" title="{{ __('tables.edit') }}" icon="fa fa-lg fa-fw fa-pen"
                onClick="window.location='{{ route('promotion1.edit', $promotion1->id); }}'" >
              </x-adminlte-button>
              <x-adminlte-button theme="danger" title="{{ __('tables.delete') }}" icon="fa fa-lg fa-fw fa-trash"
                type="submit" onclick="return confirm('{{ __('tables.confirm_delete') }}');">
              </x-adminlte-button>
            </form>
      </nobr></td>
    </tr>
  @endforeach
</x-adminlte-datatable>
@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)

