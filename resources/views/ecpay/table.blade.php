@php
$heads = [
    ['label' =>__('ecpay.id'), 'width' => 10],
    __('ecpay.trade_no'),
    __('eapplies.name'),
    __('eapplies.phone'),
    __('ecpay.trade_date'),
    __('ecpay.payment_date'),
    __('ecpay.payment_type'),
    __('ecpay.trade_amount'),
    __('ecpay.rtn_msg'),
    __('ecpay.created_at'),
    ['label' => __('tables.action'), 'no-export' => true, 'width' => 10],
];
$config = [
    'order' => [[0, 'desc']],
    'columns' => [ null, null, null, null, null, null, null, null, null, null, ['orderable' => false]],
    'language' => [ 'url' => __('tables.language_url') ],
];
@endphp

<x-adminlte-datatable id="ecpayResult-table" :heads="$heads" :config="$config" theme="info" head-theme="dark" class="table-sm"
   striped hoverable bordered with-buttons>
  @foreach($ecpayResults as $ecpayResult)
    @if ( $ecpayResult->apply->status )
    <tr>
      <td>{{ $ecpayResult->id }}</td>
      <td>{{ $ecpayResult->trade_no }}</td>
      <td>{{ $ecpayResult->apply->name }}</td>
      <td>{{ $ecpayResult->apply->phone }}</td>
      <td>{{ $ecpayResult->trade_date }}</td>
      <td>{{ $ecpayResult->payment_date }}</td>
      <td>{{ $ecpayResult->payment_type }}</td>
      <td>{{ $ecpayResult->trade_amount }}</td>
      <td>{{ $ecpayResult->rtn_msg }}</td>
      <td>{{ $ecpayResult->created_at  }}</td>
      <td><nobr>
          <form name="ecpayResult-delete-form" action="{{ route('ecpay.destroy', $ecpayResult->id); }}" method="POST">
            @csrf
            @method('DELETE')
              <x-adminlte-button theme="primary" title="{{ __('tables.edit') }}" icon="fa fa-lg fa-fw fa-pen"
                onClick="window.location='{{ route('eapplies.edit', $ecpayResult->apply->id); }}'" >
              </x-adminlte-button>
            </form>
      </nobr></td>
    </tr>
    @elseif (Auth()->user()->role == App\Enums\UserRole::Administrator)
    <tr class="bg-gray">
      <td>{{ $ecpayResult->id }}</td>
      <td>{{ $ecpayResult->trade_no }}</td>
      <td>{{ $ecpayResult->apply->name }}</td>
      <td>{{ $ecpayResult->apply->phone }}</td>
      <td>{{ $ecpayResult->trade_date }}</td>
      <td>{{ $ecpayResult->payment_date }}</td>
      <td>{{ $ecpayResult->payment_type }}</td>
      <td>{{ $ecpayResult->trade_amount }}</td>
      <td>{{ $ecpayResult->rtn_msg }}</td>
      <td>{{ $ecpayResult->created_at  }}</td>
      <td><nobr>
          <form name="ecpayResult-delete-form" action="{{ route('ecpay.destroy', $ecpayResult->id); }}" method="POST">
            @csrf
            @method('DELETE')
              <x-adminlte-button theme="primary" title="{{ __('tables.edit') }}" icon="fa fa-lg fa-fw fa-pen"
                onClick="window.location='{{ route('eapplies.edit', $ecpayResult->apply->id); }}'" >
              </x-adminlte-button>
            </form>
      </nobr></td>
    </tr>
    @endif
  @endforeach
</x-adminlte-datatable>
@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)

