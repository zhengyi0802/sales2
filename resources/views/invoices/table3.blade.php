@php
$heads = [
    ['label' =>__('invoices.id'), 'width' => 10],
    __('invoices.year'),
    __('invoices.term'),
    __('invoices.type'),
    __('invoices.header'),
    __('invoices.start'),
    __('invoices.end'),
    __('invoices.number'),
    ['label' => __('tables.action'), 'no-export' => true, 'width' => 10],
];
$config = [
    'order' => [[0, 'desc']],
    'columns' => [ null, null, null, null, null, null, null, null, ['orderable' => false]],
    'language' => [ 'url' => __('tables.language_url') ],
];
@endphp

<x-adminlte-datatable id="result-table" :heads="$heads" :config="$config" theme="info" head-theme="dark" class="table-sm"
   striped hoverable bordered with-buttons>
  @foreach($results as $result)
    <tr>
      <td>{{ $result->id }}</td>
      <td>{{ $result->year }}</td>
      <td>{{ $result->term }}</td>
      <td>{{ ($result->type == 7) ? __('invoices.type_7') : __('invoices.type_8') }}</td>
      <td>{{ $result->header }}</td>
      <td>{{ $result->start }}</td>
      <td>{{ $result->end }}</td>
      <td>{{ $result->number }}</td>
      <td>
        <x-adminlte-button theme="primary" title="{{ __('tables.edit') }}" icon="fa fa-lg fa-fw fa-pen"
          onClick="window.location='{{ route('invoices.GetInvoiceWordSetting', ['year' => $result->year, 'term' => $result->term, 'status' => 0]); }}'" >
        </x-adminlte-button>
      </td>
    </tr>
  @endforeach
</x-adminlte-datatable>
@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)

