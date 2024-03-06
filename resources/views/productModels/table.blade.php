@php
$heads = [
    ['label' =>__('productModels.id'), 'width' => 10],
    __('productModels.model'),
    __('productModels.name'),
    __('productModels.price'),
    __('productModels.vendor'),
    __('productModels.catagory'),
    __('productModels.creator'),
    ['label' => __('tables.action'), 'no-export' => true, 'width' => 10],
];
$config = [
    'order' => [[0, 'desc']],
    'columns' => [null, null, null, null, null, null, null, ['orderable' => false]],
    'language' => [ 'url' => __('tables.language_url') ],
];
@endphp

<x-adminlte-datatable id="productModel-table" :heads="$heads" :config="$config" theme="info" head-theme="dark" striped hoverable bordered>
  @foreach($productModels as $productModel)
    <tr class="{{ $productModel->status ? null : "bg-gray"}}">
      <td>{{ $productModel->id }}</td>
      <td>{{ $productModel->model }}</td>
      <td>{{ $productModel->name }}</td>
      <td>{{ ($productModel->price > 0) ? "NTD ".$productModel->price : null }}</td>
      <td>{{ $productModel->vendor->company }}</td>
      <td>{{ $productModel->catagory->name }}</td>
      <td>{{ $productModel->creator->name }}</td>
      <td><nobr>
          <form name="productModel-delete-form" action="{{ route('productModels.destroy', $productModel->id); }}" method="POST">
            @csrf
            @method('DELETE')
            @if (auth()->user()->role <= App\Enums\UserRole::Manager)
              <x-adminlte-button theme="primary" title="{{ __('tables.edit') }}" icon="fa fa-lg fa-fw fa-pen"
                onClick="window.location='{{ route('productModels.edit', $productModel->id); }}'" >
              </x-adminlte-button>
            @endif
            @if (auth()->user()->role <= App\Enums\UserRole::Manager && $productModel->status)
              <x-adminlte-button theme="danger" title="{{ __('tables.delete') }}" icon="fa fa-lg fa-fw fa-trash"
                type="submit" onclick="return confirm('{{ __('tables.confirm_delete') }}');">
              </x-adminlte-button>
             @endif
              <x-adminlte-button theme="info" title="{{ __('tables.detail') }}" icon="fa fa-lg fa-fw fa-eye"
                onClick="window.location='{{ route('productModels.show', $productModel->id); }}'" >
              </x-adminlte-button>
            </form>
      </nobr></td>
    </tr>
  @endforeach
</x-adminlte-datatable>
@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)

