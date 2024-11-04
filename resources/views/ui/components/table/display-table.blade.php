<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        @foreach($keys as $key)<th>{{ $key }}</th>@endforeach
        @foreach($forign as $key => $extractor)<th>{{ $key }}</th>@endforeach
        <th scope="col"></th>
    </tr>
    </thead>
    <tbody>
    @foreach ($ as $key)
        <tr>
            <th scope="row">@isset($list->id){{ $list->id }}@endif</th>
            @foreach($forign as $key => $extractor)<td>{{$}}</td>@endforeach

        </tr>
    @endforeach
    </tbody>
</table>

<td>
    <a href="{{ url( $link ) }}" class="btn btn-success">Show</a>
    <a href="{{ url( $link . '/edit' ) }}" class="btn btn-primary">Edit</a>
    <form action="{{ url( $link ) }}" method="POST" class="d-inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
</td>
