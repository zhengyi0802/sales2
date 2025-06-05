@php
$heads = [
    ['label' =>__('processes.id'), 'width' => 10],
    __('processes.caseName'),
    __('processes.apply_id'),
    __('processes.amount_id'),
    __('processes.name'),
    __('processes.phone'),
    __('processes.project'),
    __('processes.flow'),
    __('processes.created_at'),
    ['label' => __('tables.action'), 'no-export' => true, 'width' => 10],
];
$config = [
    'order' => [[0, 'desc']],
    'columns' => [ null, null, null, null, null, null, null, null, null, ['orderable' => false]],
    'language' => [ 'url' => __('tables.language_url') ],
];
@endphp

<x-adminlte-datatable id="process-table" :heads="$heads" :config="$config" theme="info" head-theme="dark" class="table-sm"
   striped hoverable bordered with-buttons>
  @foreach($processes as $process)
    <tr class="{{ $process->status ? null : "bg-gray"}}">
      <td>{{ $process->id }}</td>
      <td>{{ $process->case_name }}</td>
      <td>{{ ($process->apply_id > 0) ? $process->apply_id : $process->prom_id }}</td>
      <td>{{ $process->amount_id }}</td>
      <td>{{ $process->name ?? '' }}</td>
      @if (auth()->user()->role == App\Enums\UserRole::ShareHolder)
           <td>{{ str_split($process->phone, 5)[0].'****' }}</td>
      @else
           <td>{{ $process->phone }}</td>
      @endif
      <td>{{ $process->project }}</td>
      <td>{{ ($process->flow1 > 0) ? trans_choice('processes.flows', $process->flow1) : trans_choice('processes.flows', $process->flow) }} </td>
      <td>{{ $process->created_at ?? '' }}</td>
      <td><nobr>
          <form name="process-delete-form" action="{{ route('processes.destroy', $process->id); }}" method="POST">
            @csrf
            @method('DELETE')
              <x-adminlte-button theme="primary" title="{{ __('tables.edit') }}" icon="fa fa-lg fa-fw fa-pen"
                onClick="window.location='{{ route('processes.edit', $process->id); }}'" >
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

