@php
$heads = [
    ['label' =>__('invoices.id'), 'width' => 10],
    __('invoices.invoice_no'),
    __('invoices.invoice_date'),
    __('invoices.order_id'),
    __('invoices.random_number'),
    __('invoices.status'),
    ['label' => __('tables.action'), 'no-export' => true, 'width' => 20],
];
$config = [
    'order' => [[0, 'desc']],
    'columns' => [ null, null, null, null, null, null, ['orderable' => false]],
    'language' => [ 'url' => __('tables.language_url') ],
];
@endphp

<x-adminlte-datatable id="issue-table" :heads="$heads" :config="$config" theme="info" head-theme="dark" class="table-sm"
   striped hoverable bordered with-buttons>
  @foreach($issues as $issue)
    <tr>
      <td>{{ $issue->id }}</td>
      <td>{{ $issue->invoice_no }}</td>
      <td>{{ $issue->invoice_date }}</td>
      <td>{{ $issue->recordno() }}</td>
      <td>{{ $issue->random_number }}</td>
      <td>{{ $issue->invalid_flag ? __('invoices.invalid') : __('invoices.valid') }}</td>
      <td>
        <x-adminlte-button theme="secondary" title="{{ __('issues.GetIssue') }}" icon="fa fa-lg fa-fw fa-filter"
          onClick="window.location='{{ route('invoices.GetIssue', ['id' => $issue->id])  }}'" >
        </x-adminlte-button>
        <x-adminlte-button theme="primary" title="{{ __('issues.VoidWithReissue') }}" icon="fa fa-lg fa-fw fa-pen"
          onClick="window.location='{{ route('invoices.edit_issue', ['id' => $issue->id])  }}'" >
        </x-adminlte-button>
        <x-adminlte-button theme="danger" title="{{ __('issues.Invalid') }}" icon="fa fa-lg fa-fw fa-trash"
          onClick="window.location='{{ route('invoices.Invalid', ['id' => $issue->id])  }}'" >
        </x-adminlte-button>
      </td>
    </tr>
  @endforeach
</x-adminlte-datatable>
@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)
