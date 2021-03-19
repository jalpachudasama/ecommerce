@foreach($data as $k => $v)
<tr>
    <td>{{ $v->category_id }}</td>
    <td>{{ $v->category_name }}</td>
    <td>
        <form action="{{ url('/category/'.$v->category_id) }}" method="post">
            @csrf
            @method('DELETE')
            <button  type="submit" class="btn btn-sm btn-danger">Delete</button>
        </form>
        <a href="{{ url('/category/'.$v->category_id.'/edit') }}" class="btn btn-sm btn-primary">Update</a>
    </td>
</tr>
@endforeach
