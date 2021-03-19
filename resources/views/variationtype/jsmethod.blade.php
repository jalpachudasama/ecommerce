@for($i = 1; $i <= $num; $i++ )
    <input type="text" class="form-control mb-2" name="variation_type_name[]" style="border-color:lightgreen;"/>
    <small class="form-text text-muted">Enter variation type {{ $i }}</small>
@endfor
