           <x-adminlte-select name="project_id" label="{{ __('newOrders.project') }}" fgroup-class="col-md-6" >
               @foreach($projects as $project)
                   <option value="{{ $project->id }}" >{{ $project->name }}</option>
               @endforeach
           </x-adminlte-select>
