@php
$heads = [
    ['label' =>__('currencies.id'), 'width' => 10],
    __('currencies.name'),
    __('currencies.rate_field'),
    ['label' => __('tables.action'), 'no-export' => true, 'width' => 10],
];
$config = [
    'order' => [[0, 'desc']],
    'columns' => [null, null, null, ['orderable' => false]],
    'language' => [ 'url' => __('tables.language_url') ],
];
@endphp

<x-adminlte-datatable id="currency-table" :heads="$heads" :config="$config" theme="info" head-theme="dark" striped hoverable bordered>
  @foreach($currencies as $currency)
    <tr class="">
      <td contenteditable="true">{{ $currency->id }}</td>
      <td contenteditable="true">{{ $currency->currency_name }}</td>
      <td contenteditable="true">{{ 'NT$'.$currency->currency_rate }}</td>
      <td><nobr>
          <form name="currency-delete-form" action="{{ route('currencies.destroy', $currency->id); }}" method="POST">
            @csrf
            @method('DELETE')
            @if (auth()->user()->role <= App\Enums\UserRole::Manager)
              <x-adminlte-button theme="primary" title="{{ __('tables.edit') }}" icon="fa fa-lg fa-fw fa-pen"
                onClick="window.location='{{ route('currencies.edit', $currency->id); }}'" >
              </x-adminlte-button>
            @endif
            @if (auth()->user()->role <= App\Enums\UserRole::Manager && $currency->status)
              <x-adminlte-button theme="danger" title="{{ __('tables.delete') }}" icon="fa fa-lg fa-fw fa-trash"
                type="submit" onclick="return confirm('{{ __('tables.confirm_delete') }}');">
              </x-adminlte-button>
            @endif
              <x-adminlte-button theme="info" title="{{ __('tables.detail') }}" icon="fa fa-lg fa-fw fa-eye"
                onClick="window.location='{{ route('currencies.show', $currency->id); }}'" >
              </x-adminlte-button>
            </form>
      </nobr></td>
    </tr>
  @endforeach
</x-adminlte-datatable>
@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)
<script>
    $(document).ready(function() {
        $('#currency-table').DataTable();

        $('#currenct-table').on('blur', 'td[contenteditable=true]', function() {
            let newValue = $(this).text();
            let rowIndex = $(this).closest('tr').index();
            let columnIndex = $(this).index();

            // OPTIONAL: Send AJAX update to server
            console.log(`Updated value at row ${rowIndex}, col ${columnIndex}: ${newValue}`);
            // Send update to server
            $.ajax({
                url: '/api/currencies/' + rowData.id,
                method: 'PUT',
                contentType: 'application/json',
                data: JSON.stringify({
                    [columnName]: newValue
                }),
                success: function(response) {
                    console.log('Saved:', response.message);
                },
                error: function(xhr) {
                    alert('Error saving data');
                    cell.data(rowData[columnName]).draw(); // Revert on error
                }
            });
        });
    });
</script>
