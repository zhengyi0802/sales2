@php
$heads = [
    ['label' =>__('inventories.id'), 'width' => 10],
    __('inventories.serial'),
    __('inventories.product'),
    __('inventories.start_amount'),
    __('inventories.inbound'),
    __('inventories.outbound'),
    __('inventories.defective'),
    __('inventories.stock'),
    ['label' => __('tables.action'), 'no-export' => true, 'width' => 10],
];
$config = [
    'order' => [[0, 'desc']],
    'columns' => [null, null, null, null, null, null, null, null,  ['orderable' => false]],
    'language' => [ 'url' => '//cdn.datatables.net/plug-ins/1.13.4/i18n/zh-HANT.json' ],
];
@endphp

<x-adminlte-datatable id="inventory-table" :heads="$heads" :config="$config" theme="info" head-theme="dark" striped hoverable bordered>
  @foreach($inventories as $inventory)
    <tr class="{{ $inventory->status ? null : "bg-gray"}}">
      <td>{{ $inventory->id }}</td>
      <td>{{ $inventory->serial }}</td>
      <td>{{ $inventory->product->name }}</td>
      <td>{{ $inventory->start_amount }}</td>
      <td>{{ $inventory->inbound }}</td>
      <td>{{ $inventory->outbound }}</td>
      <td>{{ $inventory->defective }}</td>
      <td>{{ $inventory->stock }}</td>
      <td><nobr>
          <form name="inventory-delete-form" action="{{ route('inventories.destroy', $inventory->id); }}" method="POST">
            @csrf
            @method('DELETE')
            @if (auth()->user()->role <= App\Enums\UserRole::Manager)
              <x-adminlte-button theme="primary" title="{{ __('tables.edit') }}" icon="fa fa-lg fa-fw fa-pen"
                onClick="window.location='{{ route('inventories.edit', $inventory->id); }}'" >
              </x-adminlte-button>
            @endif
            @if (auth()->user()->role <= App\Enums\UserRole::Manager && $inventory->status)
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

