<option value="0">Select City</option>
@foreach($data as $key => $value)
    <option value="{{ $value->city_id }}">{{ $value->city_name }}</option>
@endforeach
