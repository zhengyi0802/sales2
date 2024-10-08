@php
$heads = [
    ['label' =>__('warranties.id'), 'width' => 10],
    __('warranties.order_id'),
    __('warranties.name'),
    __('warranties.phone'),
    __('warranties.register_date'),
    ['label' => __('tables.action'), 'no-export' => true, 'width' => 10],
];
$config = [
    'order' => [[0, 'desc']],
    'columns' => [null, null, null, null, null, ['orderable' => false]],
    'language' => [ 'url' => __('tables.language_url') ],
];
@endphp
<x-adminlte-datatable id="warranty-table" :heads="$heads"  :config="$config" theme="info" head-theme="dark"
    striped hoverable bordered with-buttons>
        @foreach ($warranties as $warranty)
        <tr>
            <td>{{ $warranty->id }}</td>
            <td>{{ $warranty->order_id }}</td>
            <td>{{ ($warranty->order) ? $warranty->order->name : null }}</td>
            @if (auth()->user()->role == App\Enums\UserRole::ShareHolder)
               <td>{{ str_split($warranty->phone, 5)[0].'****' }}</td>
            @else
               <td>{{ $warranty->phone }}</td>
            @endif
            <td>{{ $warranty->register_time }}</td>
            <td>
                @if ($warranty->order())
                <form action="{{ route('warranties.destroy',$warranty->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('warranties.show', $warranty->id) }}">{{ __('tables.details') }}</a>
                </form>
                @endif
            </td>
        </tr>
        @endforeach
</x-adminlte-datatable>
@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)

