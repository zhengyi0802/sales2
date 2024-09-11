    <select id="catagory_id" name="catagory_id">
        @foreach($catagories as $catagory)
            <option value="{{ $catagory->id }}">{{ $catagory->name }}</option>
        @endforeach
    </select>
