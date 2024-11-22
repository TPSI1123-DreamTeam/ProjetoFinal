<div class="row">
        <div class="col-lg-12">
            <div class="">
                <div class="table-responsive">
                    <table class="table project-list-table table-nowrap align-middle table-borderless">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Participants</th>
                                <th scope="col">Categoria</th>
                                <th scope="col">Forenecedor</th>
                                <th scope="col">Start date</th>
                                <th scope="col">End date</th>
                                <th scope="col">Type</th>
                                <th scope="col">Amount</th>
                            </tr>
                        </thead>
                        <tbody>

                        @if( !empty($events) )
                        @foreach($events as $event)
                        <tr>
                            <th scope="row" class="">{{ $loop->iteration }}
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
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="10" class="text-center">Sem eventos a decorrer</td>
                            </tr>
                          @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row g-0 align-items-center pb-4">
        <div class="col-sm-6">
            <div><p class="mb-sm-0">Showing 1 to 10 of 57 entries</p></div>
        </div>
        <div class="col-sm-6">
            <div class="float-sm-end">
                <ul class="pagination mb-sm-0">
              </ul>
            </div>
        </div>
    </div>