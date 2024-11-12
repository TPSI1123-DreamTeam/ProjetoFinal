<div class="container">
    <div class="d-flex align-items-center">
        <h2 class="d-inline mr-2 mt-5">Event List</h2>
    </div>

    <!-- @if (session('status'))
        <div class="alert {{ session('class') }} alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif -->
    <br>
    <table class="table">
        <thead class="thead-light">
        <tr style="background-color:#343a40">
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Participants</th>
            <th scope="col">Categoria</th>
            <th scope="col">Forenecedor</th>
            <th scope="col">Start date</th>
            <th scope="col">End date</th>
            <th scope="col">Type</th>
            <th scope="col">Amount</th>
            <th scope="col" style="text-align: center">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($events as $event)
            <tr>
                <th>{{$event->id}}</th>
                <td>{{$event->name}}</td>
                <td>{{ @count($event->users)}}</td>
                <td>{{$event->category->description}}</td>
                <td>
                @foreach($event->suppliers as $supplier)
                <ul>{{$supplier->name}}</ul>
                @endforeach
                </td>
                <td>{{ date('Y-m-d', strtotime($event->start_date)) }}</td>
                <td>{{ date('Y-m-d', strtotime($event->end_date)) }}</td>
                <td>{{$event->type}}</td>
                <td>{{$event->amount}}</td>
                <td>
                    <div class="d-flex align-items-center">

                        <a type="" class="mr-2" href="{{url('events/' . $event->id)}}" title="Show">
                            <button type="button" class="btn btn-primary"><i class="bi bi-eye"></i>SHOW</button>
                        </a>

                        <a type="" class="mr-2" href="{{url('events/' . $event->id) . '/edit'}}" title="Edit">
                            <button type="button" class="btn btn-success"><i class="bi bi-pencil-square"></i>EDIT</button>
                        </a>

                        <form action="{{url('events/' . $event->id)}}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" title="Delete"><i class="bi bi-trash"></i>DELETE</button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="row">
        <div class="col-6 mx-auto mt-5 ">

        </div>
    </div>
</div>