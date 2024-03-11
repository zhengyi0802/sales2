@php
$heads = [
    ['label' =>__('shippings.order_id'), 'width' => 14],
    __('shippings.phone'),
    __('shippings.flow'),
    __('shippings.shipping_date'),
    __('shippings.completion_time'),
    __('shippings.installer'),
    __('shippings.creator'),
    ['label' => __('tables.action'), 'no-export' => true, 'width' => 10],
];
$config = [
    'order' => [[0, 'desc']],
    'columns' => [null, null, null, null, null, null, null, ['orderable' => false]],
    'language' => [ 'url' => __('tables.language_url') ],
];
@endphp

<x-adminlte-datatable id="shipping-table" :heads="$heads" :config="$config" theme="info" head-theme="dark"
   striped hoverable bordered>
  @foreach($shippings as $shipping)
    <tr class="{{ $shipping->status ? null : "bg-gray"}}">
      <td>{{ $shipping->order_id }}</td>
      <td>{{ $shipping->order->phone }}</td>
      <td>{{ trans_choice('orders.flows', $shipping->order->flow) }}</td>
      <td>{{ $shipping->shipping_date }}</td>
      <td>{{ $shipping->completion_time }}</td>
      <td>{{ ($shipping->installer) ? $shipping->installer->name : null }}</td>
      <td>{{ $shipping->creator->name }}</td>
      <td><nobr>
          <form name="shipping-delete-form" action="{{ route('shippings.destroy', $shipping->id); }}" method="POST">
            @csrf
            @method('DELETE')
            @if (auth()->user()->role == App\Enums\UserRole::Administrator ||
                 auth()->user()->role <= App\Enums\UserRole::Operator ||
                 auth()->user()->role == App\Enums\UserRole::Installer)
              <x-adminlte-button theme="primary" title="{{ __('tables.edit') }}" icon="fa fa-lg fa-fw fa-pen"
                onClick="window.location='{{ route('shippings.edit', $shipping->id); }}'" >
              </x-adminlte-button>
            @endif
            @if (auth()->user()->role <= App\Enums\UserRole::Administrator)
              <x-adminlte-button theme="danger" title="{{ __('tables.delete') }}" icon="fa fa-lg fa-fw fa-trash"
                type="submit" onclick="return confirm('{{ __('tables.confirm_delete') }}');">
              </x-adminlte-button>
            @endif
            @if (auth()->user()->role != App\Enums\UserRole::ShareHolder)
              <x-adminlte-button theme="info" title="{{ __('tables.detail') }}" icon="fa fa-lg fa-fw fa-eye"
                onClick="window.location='{{ route('shippings.show', $shipping->id); }}'" >
              </x-adminlte-button>
            @endif
            </form>
      </nobr></td>
    </tr>
  @endforeach
</x-adminlte-datatable>
@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)

