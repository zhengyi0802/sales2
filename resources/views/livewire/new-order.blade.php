<x-adminlte-modal id="productsModal" title="{{ __('newOrders.product').__('') }}" theme="teal" size="lg"
   icon="fas fa-bell" v-centered static-backdrop scrollable>
   <input type="text" id="productItem" hidden />
   <select id="product_id" class="col-md-6">
     <option value="">--------</option>
     @foreach ($products as $product)
         <option value="{{ $product->name.'('.$product->model.')' }}" >{{ $product->name.'('.$product->model.')' }}</option>
     @endforeach
   </select>
</x-adminlte_modal>
        <div class="raw card-group">
           <x-adminlte-select name="project_id" label="{{ __('newOrders.project') }}"
               fgroup-class="col-md-6" wire:model="project_id" >
               @foreach($projects as $project)
                   <option value="{{ $project->id }}" >{{ $project->name }}</option>
               @endforeach
           </x-adminlte-select>
           <x-adminlte-select name="reseller_id" label="{{ __('newOrders.reseller') }}" fgroup-class="col-md-6" >
               @foreach($sales as $sale)
                   <option value="{{ $sale->id }}" >{{ $sale->name }}</option>
               @endforeach
           </x-adminlte-select>
        </div>
