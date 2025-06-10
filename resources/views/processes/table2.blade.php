@php
$heads = [
    ['label' =>__('gasexports.id'), 'width' => 10],
    __('gasexports.caseName'),
    __('gasexports.apply_id'),
    __('gasexports.path'),
    __('gasexports.ecount'),
    __('gasexports.creator'),
    __('gasexports.created_at'),
];
$config = [
    'order' => [[0, 'asc']],
    'columns' => [ null, null, null, null, null, null, null],
    'language' => [ 'url' => __('tables.language_url') ],
];
@endphp

<x-adminlte-datatable id="gasexport-table" :heads="$heads" :config="$config" theme="info" head-theme="dark" class="table-sm"
   striped hoverable bordered with-buttons>
  @foreach($gasexports as $gasexport)
    <tr>
      <td>{{ $gasexport->id }}</td>
      @if ($gasexport->proj_id == 0)
      <td>{{ '門鎖申請' }}</td>
      @elseif ($gasexport->proj_id == 1)
      <td>{{ '驚天一夏' }}</td>
      @elseif ($gasexport->proj_id == 2)
      <td>{{ '感恩孝親' }}</td>
      @endif
      <td>{{ ($gasexport->apply_id > 0) ? $gasexport->apply_id : $gasexport->prom_id }}</td>
      <td>{{ $gasexport->path }}</td>
      <td>{{ $gasexport->ecount }}</td>
      <td>{{ $gasexport->creator->name ?? null }}</td>
      <td>{{ $gasexport->created_at }}</td>
    </tr>
  @endforeach
</x-adminlte-datatable>
@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)

