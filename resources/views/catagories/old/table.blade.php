@php
$heads = [
    ['label' =>__('catagories.id'), 'width' => 10],
    __('catagories.name'),
    __('catagories.creator'),
    ['label' => __('tables.action'), 'no-export' => true, 'width' => 10],
];
$config = [
    'order' => [[0, 'desc']],
    'columns' => [null, null, null, ['orderable' => false]],
    'language' => [ 'url' => __('tables.language_url') ],
];
@endphp

<x-adminlte-datatable id="catagory-table" :heads="$heads" :config="$config" theme="info" head-theme="dark" striped hoverable bordered>
  @foreach($catagories as $catagory)
    <tr class="{{ $catagory->status ? null : "bg-gray"}}">
      <td>{{ $catagory->id }}</td>
      <td>{{ $catagory->name }}</td>
      <td>{{ $catagory->creator->name }}</td>
      <td><nobr>
          <form name="catagory-delete-form" action="{{ route('catagories.destroy', $catagory->id); }}" method="POST">
            @csrf
            @method('DELETE')
            @if (auth()->user()->role <= App\Enums\UserRole::Manager)
              <x-adminlte-button theme="primary" title="{{ __('tables.edit') }}" icon="fa fa-lg fa-fw fa-pen"
                onClick="window.location='{{ route('catagories.edit', $catagory->id); }}'" >
              </x-adminlte-button>
            @endif
            @if (auth()->user()->role <= App\Enums\UserRole::Manager && $catagory->status)
              <x-adminlte-button theme="danger" title="{{ __('tables.delete') }}" icon="fa fa-lg fa-fw fa-trash"
                type="submit" onclick="return confirm('{{ __('tables.confirm_delete') }}');">
              </x-adminlte-button>
            @endif
              <x-adminlte-button theme="info" title="{{ __('tables.detail') }}" icon="fa fa-lg fa-fw fa-eye"
                onClick="window.location='{{ route('catagories.show', $catagory->id); }}'" >
              </x-adminlte-button>
            </form>
      </nobr></td>
    </tr>
  @endforeach
</x-adminlte-datatable>
@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)

