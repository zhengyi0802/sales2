    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group col-md-4">
                <strong>{{ __('orders.project') }} :<span class="must">{{ __('tables.must') }}</span></strong>
                <select id="project_id" name="project_id" onchange="proj()">
                      <option value="" selected>--------</option>
                      @foreach ($projects as $project)
                         <option value="{{ $project->id }}" >{{ $project->name }}</option>
                      @endforeach
                </select>
            </div>
            <div class="form-group col-md-4">
                <strong>{{ __('orders.product') }} :<span class="must">{{ __('tables.must') }}</span></strong>
                <select id="product_id" name="product_id" >
                      @foreach ($productModels as $model)
                         <option value="{{ $model->id }}" >{{ $model->name }}</option>
                      @endforeach
                </select>
            </div>
            <div class="form-group col-md-4">
                <strong>{{ __('orders.extras') }} :<span class="must">{{ __('tables.must') }}</span></strong>
                <select id="extra_id" name="extra_id[]" multiple="multiple" size="10">
                      <option value="" selected >--------</option>
                      @foreach ($extras as $extra)
                         <option value="{{ $extra->id }}" >{{ $extra->name }}</option>
                      @endforeach
                </select>
            </div>
        </div>
    </div>
<script>
    function proj() {
      d = document.getElementById("project_id").value;
    }
</script>
