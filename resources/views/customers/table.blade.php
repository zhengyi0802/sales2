@php
$heads = [
    ['label' =>__('customers.id'), 'width' => 10],
    __('customers.name'),
    __('customers.phone'),
    __('customers.address'),
    __('customers.sales'),
    __('customers.creator'),
    ['label' => __('tables.action'), 'no-export' => true, 'width' => 10],
];
$config = [
    'order' => [[0, 'desc']],
    'columns' => [null, null, null, null, null, null, ['orderable' => false]],
    'language' => [ 'url' => '//cdn.datatables.net/plug-ins/1.13.4/i18n/zh-HANT.json' ],
];
@endphp

<x-adminlte-datatable id="customer-table" :heads="$heads" :config="$config" theme="info" head-theme="dark" striped hoverable bordered>
  @foreach($customers as $customer)
    <tr class="{{ $customer->status ? null : "bg-gray"}}">
      <td>{{ $customer->id }}</td>
      <td>{{ $customer->name }}</td>
      <td>{{ $customer->phone }}</td>
      <td>{{ $customer->address }}</td>
      <td>{{ $customer->sales->name }}</td>
      <td>{{ $customer->creator->name }}</td>
      <td><nobr>
          <form name="customer-delete-form" action="{{ route('customers.destroy', $customer->id); }}" method="POST">
            @csrf
            @method('DELETE')
            @if (auth()->user()->id == $customer->creator->id || auth()->user()->role == App\Enums\UserRole::Administrator)
              <x-adminlte-button theme="primary" title="{{ __('tables.edit') }}" icon="fa fa-lg fa-fw fa-pen"
                onClick="window.location='{{ route('customers.edit', $customer->id); }}'" >
              </x-adminlte-button>
            @endif
            @if ((auth()->user()->id == $customer->creator->id || auth()->user()->role == App\Enums\UserRole::Administrator) &&
                 $customer->status)
              <x-adminlte-button theme="danger" title="{{ __('tables.delete') }}" icon="fa fa-lg fa-fw fa-trash"
                type="submit" >
              </x-adminlte-button>
             @endif
              <x-adminlte-button theme="info" title="{{ __('tables.detail') }}" icon="fa fa-lg fa-fw fa-eye"
                onClick="window.location='{{ route('customers.show', $customer->id); }}'" >
              </x-adminlte-button>
            </form>
      </nobr></td>
    </tr>
  @endforeach
</x-adminlte-datatable>
@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)

