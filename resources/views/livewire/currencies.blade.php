    <select name="currency_id" id="currency_id" style="width:200px;">
        @foreach($currencies as $currency)
            <option value="{{ $currency->id }}">{{ $currency->currency_name }}</option>
        @endforeach
    </select>
