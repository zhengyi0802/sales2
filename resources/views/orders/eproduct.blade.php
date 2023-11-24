            <div class="form-group col-md-6">
                <strong>{{ __('orders.project') }} :</strong>
                <select id="project_id" name="project_id" onchange="proj()">
                      <option value="" selected>--------</option>
                      @foreach ($projects as $project)
                         <option value="{{ $project->id }}" {{ ($order->project_id == $project->id) ? "selected" : null }}>{{ $project->name }}</option>
                      @endforeach
                </select>
            </div>
            <div class="form-group col-md-6">
                <strong>{{ __('orders.product') }} :</strong>
                <select id="product_id" name="product_id" >
                      @foreach ($productModels as $model)
                         <option value="{{ $model->id }}" {{ ($order->product_id == $model->id) ? "selected" : null }}>{{ $model->name }}</option>
                      @endforeach
                </select>
            </div>
            <div class="form-group col-md-6">
                <strong>{{ __('orders.extras') }} :</strong>
                <select id="extra_id" name="extra_id[]" multiple="multiple" size="10" >
                  @foreach ($extras as $extra)
                     <option value="{{ $extra->id }}" >{{ $extra->name }}</option>
                  @endforeach
                </select>
            </div>
<script>
    function proj() {
      d = document.getElementById("project_id").value;
    }
</script>
