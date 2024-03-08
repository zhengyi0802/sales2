<ul>
  @foreach($products as $productModel)
    <li>
      <a href="{{ route('productModels.edit', $productModel->id) }}">{{ $productModel->model.'('.$productModel->name.')' }}</a>
    </li>
  @endforeach
</ul>
