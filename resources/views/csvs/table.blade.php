@php
$heads = [
     $keynames[0],
     $keynames[1],
     $keynames[2],
     $keynames[3],
     $keynames[4],
    ['label' => __('tables.action'), 'no-export' => true, 'width' => 10],
];
$config = [
    'order' => [[0, 'desc']],
    'columns' => [null, null, null, null, null, null, ['orderable' => false]],
    'language' => [ 'url' => '//cdn.datatables.net/plug-ins/1.13.4/i18n/zh-HANT.json' ],
];
@endphp

<x-adminlte-datatable id="col-table" :heads="$heads" :config="$config" theme="info" head-theme="dark" striped hoverable bordered>
  @foreach($csvs as $col)
    <tr>
      <td>{{ $col[0] }}</td>
      <td>{{ $col[1] }}</td>
      <td>{{ $col[2] }}</td>
      <td>{{ $col[3] }}</td>
      <td>{{ $col[4] }}</td>
    </tr>
  @endforeach
</x-adminlte-datatable>
@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)

