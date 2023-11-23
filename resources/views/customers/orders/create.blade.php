    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group col-md-4">
                <strong>{{ __('orders.project') }} :<span class="must">{{ __('tables.must') }}</span></strong>
                <select id="project_id" name="project_id" >
                      @foreach ($projects as $project)
                         <option value="{{ $project->id }}" >{{ $project->name }}</option>
                      @endforeach
                </select>
            </div>
            <div class="form-group col-md-4">
                <strong>{{ __('orders.product') }} :<span class="must">{{ __('tables.must') }}</span></strong>
                <select id="model_id" name="model_id" >
                      @foreach ($productModels as $model)
                         <option value="{{ $model->id }}" >{{ $model->name }}</option>
                      @endforeach
                </select>
            </div>
            <div class="form-group col-md-4">
                <strong>{{ __('orders.extras') }} :<span class="must">{{ __('tables.must') }}</span></strong>
                <select id="extra_id" name="extra_id" >
                      @foreach ($extras as $extra)
                         <option value="{{ $extra->id }}" >{{ $extra->name }}</option>
                      @endforeach
                </select>
            </div>
        </div>
    </div>
