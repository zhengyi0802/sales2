    <select id="accessories" name="accessories" multiple>
        <option value="" selected>-----------</option>
        @foreach($accessories as $accessory)
            <option value="{{ $accessory->id }}">{{ $accessory->name }}</option>
        @endforeach
    </select>
