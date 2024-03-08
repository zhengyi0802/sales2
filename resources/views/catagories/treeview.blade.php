    <div class="row col-12">
      <div class="card-group col-md-12">
        <x-adminlte-card title="{{ __('catagories.table_name') }}" icon="fas fa-lg fa-cog text-primary"
          theme="primary" icon-theme="white" fgroup-class="col-md-6" >
          <ul id="tree1">
            @foreach($catagories as $category)
              <li>
                 <a href="{{ route('catagories.edit', $category->id) }}">{{ $category->name }}</a>
                 @if(count($category->products))
                   @include('catagories.manageProduct', ['products' => $category->products])
                 @endif
              </li>
            @endforeach
          </ul>
        </x-adminlte-card>
        <x-adminlte-card title="{{ __('tables.new').__('catagories.table_name') }}" icon="fas fa-lg fa-cog text-primary"
          theme="teal" icon-theme="white" fgroup-class="col-md-6" >
            @include('catagories.createform')
        </x-adminlte-card>
      </div>
    </div>
<link href="/css/treeview.css" rel="stylesheet">
<script src="/js/treeview.js"></script>
