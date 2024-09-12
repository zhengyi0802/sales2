    <select id="project_id" name="project_name">
        <option value="" selected>-----------</option>
        @foreach($projects as $project)
            <option value="{{ $project->id }}">{{ $project->name }}</option>
        @endforeach
    </select>

