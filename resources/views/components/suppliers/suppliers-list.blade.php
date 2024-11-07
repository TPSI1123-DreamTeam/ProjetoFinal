<h1 class="pb-2">
    Suppliers List
    <span class="float-right">
        <a class="btn btn-secondary" href="{{ url('suppliers/create') }}">+ Add</a>
    </span>
</h1>
@if (session('status'))
    <div class="alert alert-success alert-dismissible fade show py-2" role="alert">
        {{ session('status') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">name</th>
            <th scope="col">email</th>
            <th scope="col">phone</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($suppliers as $supplier)
        <tr>
            <th scope="row">{{ $supplier->id }}</th>
            <td>{{$supplier->name}}</td>
            <td>{{$supplier->email}}</td>
            <td>{{$supplier->phone}}</td>
            <td>
                <a href="{{ url('suppliers/' . $supplier->id) }}" class="btn btn-success">Show</a>
                <a href="{{ url('suppliers/' . $supplier->id) . '/edit' }}" class="btn btn-primary">Edit</a>
                <form action="{{ url('suppliers/' . $supplier->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $suppliers->links() }}