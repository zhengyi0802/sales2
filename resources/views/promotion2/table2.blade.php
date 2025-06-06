@php
$heads = [
    ['label' =>__('processes.id'), 'width' => 10],
    __('processes.apply_id'),
    __('processes.project'),
    __('processes.flow'),
    __('processes.created_at'),
    __('processes.memo'),
    ['label' => __('tables.action'), 'no-export' => true, 'width' => 10],
];
$config = [
    'order' => [[0, 'desc']],
    'columns' => [ null, null, null, null, null, null, ['orderable' => false]],
    'language' => [ 'url' => __('tables.language_url') ],
];
@endphp

<x-adminlte-datatable id="process-table" :heads="$heads" :config="$config" theme="info" head-theme="dark" class="table-sm"
   striped hoverable bordered with-buttons>
  @foreach($promotion2->processes as $process)
    <tr class="{{ $process->status ? null : "bg-gray"}}">
      <td>{{ $process->id }}</td>
      <td>{{ $process->prom_id }}</td>
      <td>{{ $process->project }}</td>
      <td>{{ ($process->flow1 > 0) ? trans_choice('processes.flows', $process->flow1) : trans_choice('processes.flows', $process->flow) }} </td>
      <td>{{ $process->created_at ?? '' }}</td>
      <td>{{ $process->memo }}</td>
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

