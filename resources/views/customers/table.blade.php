@php
$heads = [
    ['label' =>__('customers.id'), 'width' => 10],
    __('customers.name'),
    __('customers.phone'),
    __('customers.address'),
    __('customers.sales'),
    __('customers.creator'),
    __('customers.created_at'),
    ['label' => __('tables.action'), 'no-export' => true, 'width' => 10],
];
$config = [
    'order' => [[0, 'desc']],
    'columns' => [null, null, null, null, null, null, null, ['orderable' => false]],
    'language' => [ 'url' => __('tables.language_url') ],
];
@endphp

@if (auth()->user()->role == App\Enums\UserRole::ShareHolder)
<x-adminlte-datatable id="customer-table" :heads="$heads" :config="$config" theme="info" head-theme="dark"
   striped hoverable bordered>
@else
<x-adminlte-datatable id="customer-table" :heads="$heads" :config="$config" theme="info" head-theme="dark" 
   striped hoverable bordered with-buttons>
@endif
  @foreach($customers as $customer)
    <tr class="{{ $customer->status ? null : "bg-gray"}}">
      <td>{{ $customer->id }}</td>
      <td>{{ $customer->name }}</td>
      @if (auth()->user()->role == App\Enums\UserRole::ShareHolder)
           <td>{{ str_split($customer->phone, 5)[0].'****' }}</td>
      @else
           <td>{{ $customer->phone }}</td>
      @endif
      <td>{{ $customer->address }}</td>
      <td>{{ $customer->sales->name }}</td>
      <td>{{ $customer->creator->name }}</td>
      <td>{{ date('Y-m-d', strtotime($customer->created_at)) }}</td>
      <td><nobr>
          <form name="customer-delete-form" action="{{ route('customers.destroy', $customer->id); }}" method="POST">
            @csrf
            @method('DELETE')
            @if (auth()->user()->id == $customer->creator->id ||
                 auth()->user()->role == App\Enums\UserRole::Operator ||
                 auth()->user()->role == App\Enums\UserRole::Administrator)
              <x-adminlte-button theme="primary" title="{{ __('tables.edit') }}" icon="fa fa-lg fa-fw fa-pen"
                onClick="window.location='{{ route('customers.edit', $customer->id); }}'" >
              </x-adminlte-button>
            @endif
            @if ((auth()->user()->id == $customer->creator->id ||
                  auth()->user()->role == App\Enums\UserRole::Operator ||
                  auth()->user()->role == App\Enums\UserRole::Administrator) &&
                 $customer->status)
              <x-adminlte-button theme="danger" title="{{ __('tables.delete') }}" icon="fa fa-lg fa-fw fa-trash"
                type="submit" onclick="return confirm('{{ __('tables.confirm_delete') }}');">
              </x-adminlte-button>
            @endif
            @if (auth()->user()->role != App\Enums\UserRole::ShareHolder)
              <x-adminlte-button theme="info" title="{{ __('tables.detail') }}" icon="fa fa-lg fa-fw fa-eye"
                onClick="window.location='{{ route('customers.show', $customer->id); }}'" >
              </x-adminlte-button>
            @endif
            </form>
      </nobr></td>
    </tr>
  @endforeach
</x-adminlte-datatable>
@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)

