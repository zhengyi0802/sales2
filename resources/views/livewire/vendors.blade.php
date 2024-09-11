    <select name="vendor_Id" id="vendor_id">
        @foreach($vendors as $vendor)
            <option value="{{ $vendor->id }}">{{ $vendor->company }}</option>
        @endforeach
    </select>
