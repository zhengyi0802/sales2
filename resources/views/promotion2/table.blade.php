@php
$heads = [
    ['label' =>__('promotion2.id'), 'width' => 10],
    __('promotion2.reseller'),
    __('promotion2.name'),
    __('promotion2.phone'),
    __('promotion2.product'),
    __('promotion2.gifts'),
    __('promotion2.payment'),
    __('promotion2.total').'/'.__('promotion2.prepay'),
    __('promotion2.paid').'/'.__('promotion2.staging'),
    __('promotion2.remain').'/'.__('promotion2.stage_price'),
    __('promotion2.flow'),
    __('promotion2.created_at'),
    ['label' => __('tables.action'), 'no-export' => true, 'width' => 10],
];
$config = [
    'order' => [[0, 'desc']],
    'columns' => [null, null, null, null, null, null, null, null, null, null, null, null, ['orderable' => false]],
    'language' => [ 'url' => __('tables.language_url') ],
];
@endphp

<x-adminlte-datatable id="promotion2-table" :heads="$heads" :config="$config" theme="info" head-theme="dark" class="table-sm"
   striped hoverable bordered with-buttons>
  @foreach($promotions as $promotion2)
    @if ($promotion2->ecpayResult != null)
    <tr class="{{ $promotion2->status ? 'bg-green' : 'bg-gray' }}">
    @else
    <tr class="{{ $promotion2->status ? null : 'bg-gray' }}">
    @endif
      <td>{{ $promotion2->id }}</td>
      <td>{{ $promotion2->reseller->name }}</td>
      <td>{{ $promotion2->name }}</td>
      @if (auth()->user()->role == App\Enums\UserRole::ShareHolder)
           <td>{{ str_split($promotion2->phone, 5)[0].'****' }}</td>
      @else
           <td>{{ $promotion2->phone }}</td>
      @endif
      <td>{{ $promotion2->product->paytype }}</td>
      <td>
            @foreach (json_decode($promotion2->gifts) as $gift)
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
      <td>{{ ($promotion2->payment == 11) ? __('promotion2.payment_third') : __('promotion2.payment_credit') }}</td>
@if ($promotion2->paytype_id == 1)
      <td>{{ __('currencies.NTD').$promotion2->total.__('currencies.ntd_unit') }}</td>
      <td>{{ __('currencies.NTD').$promotion2->paid.__('currencies.ntd_unit') }}</td>
      <td>{{ __('currencies.NTD').$promotion2->remain.__('currencies.ntd_unit') }}</td>
@else
  @if ($promotion2->prepay_total > 0)
      <td>{{ __('currencies.NTD').$promotion2->prepay_total.__('currencies.ntd_unit') }}</td>
  @else
      <td>------</td>
  @endif
      <td>{{ $promotion2->staging.__('promotion2.staging_unit') }}</td>
      <td>{{ __('currencies.NTD').$promotion2->stage_price.__('currencies.ntd_unit') }}</td>
@endif
      <td>{{ ($promotion2->flow1 > 0) ? trans_choice('promotion2.flows', $promotion2->flow1) : trans_choice('promotion2.flows', $promotion2->flow) }} </td>
      <td>{{ $promotion2->created_at ?? '' }}</td>
      <td><nobr>
          <form name="promotion-delete-form" action="{{ route('promotion2.destroy', $promotion2->id); }}" method="POST">
            @csrf
            @method('DELETE')
              <x-adminlte-button theme="primary" title="{{ __('tables.edit') }}" icon="fa fa-lg fa-fw fa-pen"
                onClick="window.location='{{ route('promotion2.edit', $promotion2->id); }}'" >
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

