@php
$heads = [
    ['label' =>__('ecpay.id'), 'width' => 10],
    __('ecpay.trade_no'),
    __('eapplies.name'),
    __('eapplies.phone'),
    __('ecpay.trade_date'),
    __('ecpay.payment_type'),
    __('ecpay.trade_amount'),
    __('ecpay.rtn_msg'),
    __('ecpay.created_at'),
    ['label' => __('tables.action'), 'no-export' => true, 'width' => 10],
];
$config = [
    'order' => [[0, 'desc']],
    'columns' => [ null, null, null, null, null, null, null, null, null, ['orderable' => false]],
    'language' => [ 'url' => __('tables.language_url') ],
];
@endphp

<x-adminlte-datatable id="ecpayInfo-table" :heads="$heads" :config="$config" theme="info" head-theme="dark" class="table-sm"
   striped hoverable bordered with-buttons>
  @foreach($ecpayInfos as $ecpayInfo)
    <tr>
      <td>{{ $ecpayInfo->id }}</td>
      <td>{{ $ecpayInfo->trade_no }}</td>
      <td>{{ $ecpayInfo->apply->name ?? $ecpayInfo->promotion->name }}</td>
      <td>{{ $ecpayInfo->apply->phone ?? $ecpayInfo->promotion->phone }}</td>
      <td>{{ $ecpayInfo->trade_date }}</td>
      <td>{{ $ecpayInfo->payment_type }}</td>
      <td>{{ $ecpayInfo->payment_total }}</td>
      <td>{{ $ecpayInfo->rtn_msg }}</td>
      <td>{{ $ecpayInfo->created_at }}</td>
      <td><nobr>
          <form name="ecpayInfo-delete-form" action="{{ route('ecpay.destroy', $ecpayInfo->id); }}" method="POST">
            @csrf
            @method('DELETE')
            @if ($ecpayInfo->apply)
              <x-adminlte-button theme="primary" title="{{ __('tables.edit') }}" icon="fa fa-lg fa-fw fa-pen"
                onClick="window.location='{{ route('eapplies.edit', $ecpayInfo->apply->id); }}'" >
              </x-adminlte-button>
            @elseif($ecpayInfo->promotion->proj_id == 1)
              <x-adminlte-button theme="primary" title="{{ __('tables.edit') }}" icon="fa fa-lg fa-fw fa-pen"
                onClick="window.location='{{ route('promotion1.edit', $ecpayInfo->promotion->id); }}'" >
              </x-adminlte-button>
            @else
              <x-adminlte-button theme="primary" title="{{ __('tables.edit') }}" icon="fa fa-lg fa-fw fa-pen"
                onClick="window.location='{{ route('promotion2.edit', $ecpayInfo->promotion->id); }}'" >
              </x-adminlte-button>
            @endif
            </form>
      </nobr></td>
    </tr>
  @endforeach
</x-adminlte-datatable>
@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)

