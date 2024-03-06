@php
$heads = [
    ['label' =>__('massorders.id'), 'width' => 10],
    __('massorders.order_date'),
    __('massorders.cname'),
    __('massorders.flow'),
    __('massorders.outbound_date'),
    __('massorders.arrived_date'),
    __('massorders.creator'),
    ['label' => __('tables.action'), 'no-export' => true, 'width' => 10],
];
$config = [
    'order' => [[0, 'desc']],
    'columns' => [null, null, null, null, null, null, null, ['orderable' => false]],
    'language' => [ 'url' => __('tables.language_url') ],
];
@endphp

<x-adminlte-datatable id="massorder-table" :heads="$heads" :config="$config" theme="info" head-theme="dark" striped hoverable bordered>
  @foreach($massOrders as $massOrder)
    <tr class="{{ $massOrder->status ? null : "bg-gray"}}">
      <td>{{ $massOrder->id }}</td>
      <td>{{ $massOrder->order_date }}</td>
      <td>{{ $massOrder->cname }}</td>
      <td>{{ trans_choice('massorders.flows',$massOrder->flow) }}</td>
      <td>{{ $massOrder->outbound_date }}</td>
      <td>{{ $massOrder->arrived_date }}</td>
      <td>{{ $massOrder->creator->name }}</td>
      <td><nobr>
          <form name="massorder-delete-form" action="{{ route('massOrders.destroy', $massOrder->id); }}" method="POST">
            @csrf
            @method('DELETE')
              <x-adminlte-button theme="primary" title="{{ __('tables.edit') }}" icon="fa fa-lg fa-fw fa-pen"
                onClick="window.location='{{ route('massOrders.edit', $massOrder->id); }}'" >
              </x-adminlte-button>
              <x-adminlte-button theme="danger" title="{{ __('tables.delete') }}" icon="fa fa-lg fa-fw fa-trash"
                type="submit" onclick="return confirm('{{ __('tables.confirm_delete') }}');">
              </x-adminlte-button>
              <x-adminlte-button theme="info" title="{{ __('tables.detail') }}" icon="fa fa-lg fa-fw fa-eye"
                onClick="window.location='{{ route('massOrders.show', $massOrder->id); }}'" >
              </x-adminlte-button>
            </form>
      </nobr></td>
    </tr>
  @endforeach
</x-adminlte-datatable>
@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)

