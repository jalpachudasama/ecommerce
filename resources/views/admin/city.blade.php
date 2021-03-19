<option value="0">Select State</option>
@foreach($sdata as $key => $value)
<option value="{{ $value->state_id }}" {{ ($value->state_id == $cdata->city_state_id) ? 'selected' : ''  }}>{{ $value->state_name }}</option>
@endforeach
