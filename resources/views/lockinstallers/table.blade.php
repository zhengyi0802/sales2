@php
$heads = [
    ['label' =>__('lockinstallers.id'), 'width' => 10],
    __('lockinstallers.reseller'),
    __('lockinstallers.name'),
    __('lockinstallers.phone'),
    __('lockinstallers.project'),
    __('lockinstallers.payment'),
    __('lockinstallers.total'),
    __('lockinstallers.paid'),
    __('lockinstallers.remain'),
    __('lockinstallers.flow'),
    __('lockinstallers.created_at'),
    ['label' => __('tables.action'), 'no-export' => true, 'width' => 10],
];
$config = [
    'order' => [[0, 'desc']],
    'columns' => [null, null, null, null, null, null, null, null, null, null, null, ['orderable' => false]],
    'language' => [ 'url' => __('tables.language_url') ],
];
@endphp

<x-adminlte-datatable id="lockInstaller-table" :heads="$heads" :config="$config" theme="info" head-theme="dark" class="table-sm"
   striped hoverable bordered with-buttons>
  @foreach($lockInstallers as $lockInstaller)
    <tr class="{{ $lockInstaller->status ? null : "bg-gray"}}">
      <td>{{ $lockInstaller->id }}</td>
      <td>{{ $lockInstaller->reseller->name }}</td>
      <td>{{ $lockInstaller->name }}</td>
      @if (auth()->user()->role == App\Enums\UserRole::ShareHolder)
           <td>{{ str_split($lockInstaller->phone, 5)[0].'****' }}</td>
      @else
           <td>{{ $lockInstaller->phone }}</td>
      @endif
      <td>{{ $lockInstaller->project->name }}</td>
      <td>{{ ($lockInstaller->payment == 11) ? __('lockinstallers.payment_third') : __('lockinstallers.payment_credit') }}</td>
      <td>{{ $lockInstaller->total }}</td>
      <td>{{ $lockInstaller->paid }}</td>
      <td>{{ $lockInstaller->remain }}</td>
      <td>{{ ($lockInstaller->flow1 > 0) ? trans_choice('lockinstallers.flows', $lockInstaller->flow1) : trans_choice('lockinstallers.flows', $lockInstaller->flow) }} </td>
      <td>{{ $lockInstaller->created_at ?? '' }}</td>
      <td><nobr>
          <form name="lockInstaller-delete-form" action="{{ route('lockinstallers.destroy', $lockInstaller->id); }}" method="POST">
            @csrf
            @method('DELETE')
              <x-adminlte-button theme="primary" title="{{ __('tables.edit') }}" icon="fa fa-lg fa-fw fa-pen"
                onClick="window.location='{{ route('lockinstallers.edit', $lockInstaller->id); }}'" >
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

