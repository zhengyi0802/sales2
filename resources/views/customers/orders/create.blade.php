    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
          <table>
            <tr class="form-group col-md-4">
                <td><strong>{{ __('orders.project') }} :<span class="must">{{ __('tables.must') }}</span></strong></td>
                <td><select id="project_id" name="project_id" onchange="proj()">
                      <option value="" selected>--------</option>
                      @foreach ($projects as $project)
                         <option value="{{ $project->id }}" >{{ $project->name }}</option>
                      @endforeach
                </select></td>
            </tr>
            <tr class="form-group col-md-4">
                <td><strong>{{ __('orders.product') }} :<span class="must">{{ __('tables.must') }}</span></strong></td>
                <td><select id="product_id" name="product_id" >
                      @foreach ($productModels as $model)
                         <option value="{{ $model->id }}" >{{ $model->name }}</option>
                      @endforeach
                </select></td>
            </tr>
            <tr class="form-group col-md-4">
                <td><strong>{{ __('orders.extras') }} :</strong></td>
                <td><select id="extra_id" name="extra_id[]" multiple="multiple" size="10">
                      @foreach ($extras as $extra)
                         <option value="{{ $extra->id }}" >{{ $extra->name }}</option>
                      @endforeach
                </select></td>
            </tr>
          </table>
        </div>
    </div>
<script>
    function proj() {
      d = document.getElementById("project_id").value;
    }
</script>
