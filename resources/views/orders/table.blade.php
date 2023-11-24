@php
$heads = [
    ['label' =>__('orders.id'), 'width' => 10],
    __('orders.name'),
    __('orders.phone'),
    __('orders.product'),
    __('orders.sales'),
    __('orders.creator'),
    ['label' => __('tables.action'), 'no-export' => true, 'width' => 10],
];
$config = [
    'order' => [[0, 'desc']],
    'columns' => [null, null, null, null, null, null, null, ['orderable' => false]],
    'language' => [ 'url' => '//cdn.datatables.net/plug-ins/1.13.4/i18n/zh-HANT.json' ],
];
@endphp

<x-adminlte-datatable id="order-table" :heads="$heads" :config="$config" theme="info" head-theme="dark" striped hoverable bordered>
  @foreach($orders as $order)
    <tr class="{{ $order->status ? null : "bg-gray"}}">
      <td>{{ $order->id }}</td>
      <td>{{ $order->name }}</td>
      <td>{{ $order->phone }}</td>
      <td>{{ $order->product->model }}</td>
      <td>{{ $order->sales->name }}</td>
      <td>{{ $order->creator->name }}</td>
      <td><nobr>
          <form name="order-delete-form" action="{{ route('orders.destroy', $order->id); }}" method="POST">
            @csrf
            @method('DELETE')
            @if (auth()->user()->role == App\Enums\UserRole::Operator || auth()->user()->role == App\Enums\UserRole::Administrator)
              <x-adminlte-button theme="primary" title="{{ __('tables.edit') }}" icon="fa fa-lg fa-fw fa-pen"
                onClick="window.location='{{ route('orders.edit', $order->id); }}'" >
              </x-adminlte-button>
            @endif
            @if (auth()->user()->role == App\Enums\UserRole::Operator || auth()->user()->role == App\Enums\UserRole::Administrator)
              <x-adminlte-button theme="danger" title="{{ __('tables.delete') }}" icon="fa fa-lg fa-fw fa-trash"
                type="submit" >
              </x-adminlte-button>
             @endif
              <x-adminlte-button theme="info" title="{{ __('tables.detail') }}" icon="fa fa-lg fa-fw fa-eye"
                onClick="window.location='{{ route('orders.show', $order->id); }}'" >
              </x-adminlte-button>
            </form>
      </nobr></td>
    </tr>
  @endforeach
</x-adminlte-datatable>
@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)

