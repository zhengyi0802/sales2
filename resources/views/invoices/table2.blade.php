@php
$heads = [
    ['label' =>__('invoices.id'), 'width' => 10],
    __('invoices.year'),
    __('invoices.term'),
    __('invoices.header'),
    __('invoices.start'),
    __('invoices.end'),
    __('invoices.TrackID'),
    __('invoices.invoice_no'),
    __('invoices.status'),
];
$config = [
    'order' => [[0, 'desc']],
    'columns' => [ null, null, null, null, null, null, null, null, null],
    'language' => [ 'url' => __('tables.language_url') ],
];
@endphp

<x-adminlte-datatable id="inv-table" :heads="$heads" :config="$config" theme="info" head-theme="dark" class="table-sm"
   striped hoverable bordered with-buttons>
@if (isset($invs))
  @foreach($invs as $inv1)
    <tr>
      <td>{{ $inv1->id }}</td>
      <td>{{ $inv1->year }}</td>
      <td>{{ $inv1->term }}</td>
      <td>{{ $inv1->header }}</td>
      <td>{{ $inv1->start }}</td>
      <td>{{ $inv1->end }}</td>
      <td>{{ $inv1->track_id }}</td>
      <td>{{ $inv1->invoice_no }}</td>
      <td>{{ trans_choice( __('invoices.statuses'), $inv1->status) }}</td>
    </tr>
  @endforeach
@endif
</x-adminlte-datatable>
@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)

