@php
$heads = [
    ['label' =>__('checkorders.id'), 'width' => 10],
    __('orders.order_date'),
    __('checkorders.name'),
    __('checkorders.phone'),
    __('checkorders.project'),
    __('orders.product'),
    __('checkorders.sales'),
    ['label' => __('tables.action'), 'no-export' => true, 'width' => 10],
];
$config = [
    'order' => [[0, 'desc']],
    'columns' => [null, null, null, null, null, null, null, ['orderable' => false]],
    'language' => [ 'url' => __('tables.language_url') ],
];
@endphp

<x-adminlte-datatable id="customer-table" :heads="$heads" :config="$config" theme="info" head-theme="dark" striped hoverable bordered>
  @foreach($customers as $customer)
    <tr class="{{ $customer->status ? null : "bg-gray"}}">
      <td>{{ $customer->id }}</td>
      <td>{{ $customer->order->order_date }}</td>
      <td>{{ $customer->name }}</td>
      @if (auth()->user()->role == App\Enums\UserRole::ShareHolder)
           <td>{{ str_split($customer->phone, 5)[0].'****' }}</td>
      @else
           <td>{{ $customer->phone }}</td>
      @endif
      <td>{{ $customer->order->project->name }}</td>
       <td>{{ $customer->order->product->model }}</td>
      <td>{{ $customer->sales->name ?? '' }}</td>
      <td><nobr>
          <form name="customer-delete-form" action="{{ route('checkOrders.destroy', $customer->id); }}" method="POST">
            @csrf
            @method('DELETE')
              <x-adminlte-button theme="primary" title="{{ __('tables.edit') }}" icon="fa fa-lg fa-fw fa-pen"
                onClick="window.location='{{ route('checkOrders.edit', $customer->id); }}'" >
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

