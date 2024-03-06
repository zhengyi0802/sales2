    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group col-md-4">
                <strong>{{ __('orders.order_date') }} :</strong>
                <input type="date" name="order_date" class="form-control" value="{{ date('Y-m-d') }}">
            </div>
          <table>
            <tr class="form-group col-md-4">
                <td><strong>{{ __('orders.project') }} :<span class="must">{{ __('tables.must') }}</span></strong></td>
                <td><select id="project_id" name="project_id">
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
                      <option value="0">----------</option>
                      @foreach ($extras as $extra)
                         <option value="{{ $extra->id }}" >{{ $extra->name }}</option>
                      @endforeach
                </select></td>
            </tr>
          </table>
        </div>
    </div>
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script>
    $(document).ready(function(){
        $('#customer-form').validate({
           onkeyup: function(element, event) {
               var value = this.elementValue(element).replace(/^\s+/g, "");
               $(element).val(value);
           },
           rules: {
               project_id: {
                  required: true
               },
               product_id: {
                  required: true
               },
           },
           messages: {
               project_id: {
                  required: '行銷方案必選'
               },
               product_id: {
                  required: '產品型號必選'
               },
           },
           submitHandler: function(form) {
                form.submit();
           }
        });
    });
</script>
@section('plugins.jqueryValidation', true)
