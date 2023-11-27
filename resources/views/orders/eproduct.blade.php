         <table>
            <tr class="form-group col-md-6">
                <td><strong>{{ __('orders.project') }} :</strong></td>
                <td><select id="project_id" name="project_id" onchange="proj()">
                      <option value="" selected>--------</option>
                      @foreach ($projects as $project)
                         <option value="{{ $project->id }}" {{ ($order->project_id == $project->id) ? "selected" : null }}>{{ $project->name }}</option>
                      @endforeach
                </select></td>
            </tr>
            <tr class="form-group col-md-6">
                <td><strong>{{ __('orders.product') }} :</strong></td>
                <td><select id="product_id" name="product_id" >
                      @foreach ($productModels as $model)
                         <option value="{{ $model->id }}" {{ ($order->product_id == $model->id) ? "selected" : null }}>{{ $model->name }}</option>
                      @endforeach
                </select></td>
            </tr>
            <tr class="form-group col-md-6">
                <td><strong>{{ __('orders.extras') }} :</strong></td>
                <td><select id="extra_id" name="extra_id[]" multiple="multiple" size="10" >
                     <option value="0">----------</option>
                  @foreach ($extras as $extra)
                     <option value="{{ $extra->id }}" >{{ $extra->name }}</option>
                  @endforeach
                </select></td>
            </tr>
            <tr class="form-group col-md-6">
                <td><strong>{{ __('orders.flow') }} :</strong></td>
                <td><select id="flow" name="flow" >
                  <option value="1" >{{ trans_choice('orders.flows', 1) }}</option>
                  <option value="2" >{{ trans_choice('orders.flows', 2) }}</option>
                  <option value="3" >{{ trans_choice('orders.flows', 3) }}</option>
                  <option value="4" >{{ trans_choice('orders.flows', 4) }}</option>
                  <option value="5" >{{ trans_choice('orders.flows', 5) }}</option>
                  <option value="6" >{{ trans_choice('orders.flows', 6) }}</option>
                </select></td>
            </tr>
            <tr class="form-group col-md-6">
                <td><strong>{{ __('orders.memo') }} :</strong></td>
                <td><textarea name="memo" rows="10"></textarea></td>
            </tr>
         </table>
<script>
    function proj() {
      d = document.getElementById("project_id").value;
    }
</script>
