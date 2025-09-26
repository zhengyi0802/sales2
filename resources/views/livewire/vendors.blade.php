    <select name="vendor_id" id="vendor_id" wire:model="VendorId">
        @foreach($vendors as $vendor)
            <option value="{{ $vendor->id }}">{{ $vendor->company }}</option>
        @endforeach
    </select>
    {{ $VendorId }}
