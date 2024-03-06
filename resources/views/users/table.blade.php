@php
$heads = [
    ['label' =>__('users.id'), 'width' => 10],
    __('users.account'),
    __('users.name'),
    __('users.phone'),
    __('users.role'),
    __('users.creator'),
    ['label' => __('tables.action'), 'no-export' => true, 'width' => 10],
];
$config = [
    'order' => [[0, 'desc']],
    'columns' => [null, null, null, null, null, null, ['orderable' => false]],
    'language' => [ 'url' => __('tables.language_url') ],
];
@endphp

<x-adminlte-datatable id="user-table" :heads="$heads" :config="$config" theme="info" head-theme="dark" striped hoverable bordered>
  @foreach($users as $user)
    <tr class="{{ $user->status ? null : "bg-gray"}}">
      <td>{{ $user->id }}</td>
      <td>{{ $user->account }}</td>
      <td>{{ $user->name }}</td>
      <td>{{ str_split($user->phone, 5)[0]."****" }}</td>
      <td>{{ trans_choice('users.roles', $user->role) }}</td>
      <td>{{ $user->creator->name }}</td>
      <td><nobr>
          <form name="user-delete-form" action="{{ route('users.destroy', $user->id); }}" method="POST">
            @csrf
            @method('DELETE')
            @if (auth()->user()->role <= App\Enums\UserRole::Manager && $user->id > 2)
              <x-adminlte-button theme="primary" title="{{ __('tables.edit') }}" icon="fa fa-lg fa-fw fa-pen"
                onClick="window.location='{{ route('users.edit', $user->id); }}'" >
              </x-adminlte-button>
            @endif
            @if (auth()->user()->role <= App\Enums\UserRole::Manager && $user->id > 3)
              <x-adminlte-button theme="danger" title="{{ __('tables.delete') }}" icon="fa fa-lg fa-fw fa-trash"
                type="submit" onclick="return confirm('{{ __('tables.confirm_delete') }}');">
              </x-adminlte-button>
             @endif
              <x-adminlte-button theme="info" title="{{ __('tables.detail') }}" icon="fa fa-lg fa-fw fa-eye"
                onClick="window.location='{{ route('users.show', $user->id); }}'" >
              </x-adminlte-button>
            </form>
      </nobr></td>
    </tr>
  @endforeach
</x-adminlte-datatable>
@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)

