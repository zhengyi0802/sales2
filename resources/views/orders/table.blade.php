@php
$heads = [
    ['label' =>__('orders.id'), 'width' => 10],
    __('orders.flow'),
    __('orders.name'),
    __('orders.phone'),
    __('orders.project'),
    __('orders.product'),
    __('orders.order_date'),
    __('orders.sales'),
    __('orders.creator'),
    ['label' => __('tables.action'), 'no-export' => true, 'width' => 10],
];
$config = [
    'order' => [[0, 'desc']],
    'columns' => [null, null, null, null, null, null, null, null, null, ['orderable' => false]],
    'language' => [ 'url' => '//cdn.datatables.net/plug-ins/1.13.4/i18n/zh-HANT.json' ],
];
@endphp

<x-adminlte-datatable id="order-table" :heads="$heads" :config="$config" theme="info" head-theme="dark" striped hoverable bordered>
  @foreach($orders as $order)
    <tr class="{{ ($order->status || $order->flow == 6) ? null : "bg-gray"}}">
      <td>{{ $order->id }}</td>
      <td>{{ trans_choice('orders.flows', $order->flow) }}</td>
      <td>{{ $order->name }}</td>
      @if (auth()->user()->role == App\Enums\UserRole::ShareHolder)
            <td>{{ str_split($order->phone, 5)[0].'****' }}</td>
      @else
            <td>{{ $order->phone }}</td>
      @endif
      <td>{{ $order->project->name }}</td>
      <td>{{ $order->product->model }}</td>
      <td>{{ ($order->order_date) ? $order->order_date : date('Y-m-d', strtotime($order->created_at)) }}</td>
      <td>{{ $order->sales->name }}</td>
      <td>{{ $order->creator->name }}</td>
      <td><nobr>
          <form name="order-delete-form" action="{{ route('orders.destroy', $order->id); }}" method="POST">
            @csrf
            @method('DELETE')
            @if (auth()->user()->id == $order->creator->id ||
                 auth()->user()->role == App\Enums\UserRole::Operator ||
                 auth()->user()->role == App\Enums\UserRole::Administrator)
              <x-adminlte-button theme="primary" title="{{ __('tables.edit') }}" icon="fa fa-lg fa-fw fa-pen"
                onClick="window.location='{{ route('orders.edit', $order->id); }}'" >
              </x-adminlte-button>
            @endif
            @if ((auth()->user()->id == $order->creator->id ||
                  auth()->user()->role == App\Enums\UserRole::Operator ||
                  auth()->user()->role == App\Enums\UserRole::Administrator) &&
                 $order->status)
              <x-adminlte-button theme="danger" title="{{ __('tables.delete') }}" icon="fa fa-lg fa-fw fa-trash"
                type="submit" onclick="return confirm('{{ __('tables.confirm_delete') }}');">
              </x-adminlte-button>
             @endif
             @if (auth()->user()->role != App\Enums\UserRole::ShareHolder)
              <x-adminlte-button theme="info" title="{{ __('tables.detail') }}" icon="fa fa-lg fa-fw fa-eye"
                onClick="window.location='{{ route('orders.show', $order->id); }}'" >
              </x-adminlte-button>
             @endif
            </form>
      </nobr></td>
    </tr>
  @endforeach
</x-adminlte-datatable>
@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)

