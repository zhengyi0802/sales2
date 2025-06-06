@php
$heads = [
    ['label' =>__('saleses.id'), 'width' => 10],
    __('saleses.name'),
    __('saleses.company'),
    __('saleses.phone'),
    __('saleses.identity'),
    __('saleses.upper'),
    __('saleses.creator'),
    ['label' => __('tables.action'), 'no-export' => true, 'width' => 10],
];
$config = [
    'order' => [[0, 'desc']],
    'columns' => [null, null, null, null, null, null, null, ['orderable' => false]],
    'language' => [ 'url' => __('tables.language_url') ],
];
@endphp

<x-adminlte-datatable id="sales-table" :heads="$heads" :config="$config" theme="info" head-theme="dark" striped hoverable bordered>
  @foreach($saleses as $sales)
    <tr class="{{ $sales->status ? null : "bg-gray"}}">
      <td>{{ $sales->id }}</td>
      <td>{{ $sales->name }}</td>
      <td>{{ $sales->company }}</td>
      <td>{{ str_split($sales->phone, 5)[0]."****" }}</td>
      <td>{{ ($sales->user->role == App\Enums\UserRole::Sales) ? __('saleses.id_sales') : __('saleses.id_reseller') }}
      <td>{{ $sales->upper->name ?? '' }}</td>
      <td>{{ $sales->creator->name ?? '' }}</td>
      <td><nobr>
          <form name="sales-delete-form" action="{{ route('sales.destroy', $sales->id); }}" method="POST">
            @csrf
            @method('DELETE')
            @if (auth()->user()->role <= App\Enums\UserRole::Manager)
              <x-adminlte-button theme="primary" title="{{ __('tables.edit') }}" icon="fa fa-lg fa-fw fa-pen"
                onClick="window.location='{{ route('sales.edit', $sales->id); }}'" >
              </x-adminlte-button>
            @endif
            @if (auth()->user()->role <= App\Enums\UserRole::Manager && $sales->status)
              <x-adminlte-button theme="danger" title="{{ __('tables.delete') }}" icon="fa fa-lg fa-fw fa-trash"
                type="submit" onclick="return confirm('{{ __('tables.confirm_delete') }}');">
              </x-adminlte-button>
             @endif
             @if (auth()->user()->role != App\Enums\UserRole::ShareHolder)
              <x-adminlte-button theme="info" title="{{ __('tables.detail') }}" icon="fa fa-lg fa-fw fa-eye"
                onClick="window.location='{{ route('sales.show', $sales->id); }}'" >
              </x-adminlte-button>
             @endif
            </form>
      </nobr></td>
    </tr>
  @endforeach
</x-adminlte-datatable>
@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)

