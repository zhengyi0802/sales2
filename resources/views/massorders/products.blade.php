<x-adminlte-modal id="productsModal" title="{{ __('massorders.product').__('') }}" theme="teal" size="lg"
   icon="fas fa-bell" v-centered static-backdrop scrollable>
   <input type="text" id="productItem" hidden />
   <select id="product_id" class="col-md-6">
     <option value="">--------</option>
     @foreach ($productModels as $product)
         <option value="{{ $product->name.'('.$product->model.')' }}" >{{ $product->name.'('.$product->model.')' }}</option>
     @endforeach
   </select>
</x-adminlte_modal>

