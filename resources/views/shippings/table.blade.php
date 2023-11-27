@php
$heads = [
    ['label' =>__('shippings.id'), 'width' => 10],
    __('shippings.name'),
    __('shippings.creator'),
    ['label' => __('tables.action'), 'no-export' => true, 'width' => 10],
];
$config = [
    'order' => [[0, 'desc']],
    'columns' => [null, null, null, ['orderable' => false]],
    'language' => [ 'url' => '//cdn.datatables.net/plug-ins/1.13.4/i18n/zh-HANT.json' ],
];
@endphp

<x-adminlte-datatable id="shipping-table" :heads="$heads" :config="$config" theme="info" head-theme="dark" striped hoverable bordered>
  @foreach($shippingProcesses as $shipping)
    <tr class="{{ $shipping->status ? null : "bg-gray"}}">
      <td>{{ $shipping->id }}</td>
      <td>{{ $shipping->name }}</td>
      <td>{{ $shipping->creator->name }}</td>
      <td><nobr>
          <form name="shipping-delete-form" action="{{ route('shippings.destroy', $shipping->id); }}" method="POST">
            @csrf
            @method('DELETE')
            @if (auth()->user()->role <= App\Enums\UserRole::Manager)
              <x-adminlte-button theme="primary" title="{{ __('tables.edit') }}" icon="fa fa-lg fa-fw fa-pen"
                onClick="window.location='{{ route('shippings.edit', $shipping->id); }}'" >
              </x-adminlte-button>
            @endif
            @if (auth()->user()->role <= App\Enums\UserRole::Manager && $shipping->status)
              <x-adminlte-button theme="danger" title="{{ __('tables.delete') }}" icon="fa fa-lg fa-fw fa-trash"
                type="submit" onclick="return confirm('{{ __('tables.confirm_delete') }}');">
              </x-adminlte-button>
            @endif
              <x-adminlte-button theme="info" title="{{ __('tables.detail') }}" icon="fa fa-lg fa-fw fa-eye"
                onClick="window.location='{{ route('shippings.show', $shipping->id); }}'" >
              </x-adminlte-button>
            </form>
      </nobr></td>
    </tr>
  @endforeach
</x-adminlte-datatable>
@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)

