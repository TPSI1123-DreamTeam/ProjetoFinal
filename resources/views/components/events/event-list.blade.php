
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.0/css/boxicons.min.css" integrity="sha512-pVCM5+SN2+qwj36KonHToF2p1oIvoU3bsqxphdOIWMYmgr4ZqD3t5DjKvvetKhXGc/ZG5REYTT6ltKfExEei/Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.3.45/css/materialdesignicons.css" integrity="sha256-NAxhqDvtY0l4xn+YVa6WjAcmd94NNfttjNsDmNatFVc=" crossorigin="anonymous" />

<div class="container">
    <div class="row align-items-center">
        <div class="col-md-6 mt-3">
            <div class="mb-3">
                <h5 class="card-title">Event List<span class="text-muted fw-normal ms-2">
                @if(isset($participants) && $participants->users && $participants->users->isNotEmpty() && isset($participants->users))
                    ({{ count($participants->users) }})
                @else
                    (0)
                @endif
                </span></h5>
                <h6 class="card-title">
                  @if(isset($participants) && $participants->users && $participants->users->isNotEmpty())
                  Evento: {{ $participants->name }} - Data: {{ $participants->start_date }} - Hora: {{ date('H:i', strtotime($participants->start_time)) }}
                  @endif
                 <span class="text-muted fw-normal ms-2"></h6>
            </div>
        </div>

          <div class="d-flex flex-wrap align-items-center justify-content-end gap-2 mb-3">

            <div class="col-md-6 ">
              <div class="form-group">
                <form action="/searchEvents" method="POST">
                  @csrf
                  <div class="input-group">
                    <select class="form-control" id="search" name="search">
                      <option selected>Escolha o evento para listar participantes...</option>
                      @foreach ($events as $event)
                      <option value="{{ $event->id }}" {{ request()->input('search') == $event->id ? 'selected' :'' }}>{{ $event->name }}</option>
                      @endforeach

                    </select>
                    <button type="submit" class="btn btn-primary" >Search</button>
                  </div>
                </form>
              </div>
            </div>
        </div>

    </div>
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
                                <th scope="col" style="width: 200px;">Actions</th>
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
</div>

<style>
body{

  margin-top:20px;
  background-color:#eee;
}
.project-list-table {
    border-collapse: separate;
    border-spacing: 0 12px
}

.project-list-table tr {
    background-color: #fff
}

.table-nowrap td, .table-nowrap th {
    white-space: nowrap;
}
.table-borderless>:not(caption)>*>* {
    border-bottom-width: 0;
}
.table>:not(caption)>*>* {
    padding: 0.75rem 0.75rem;
    background-color: var(--bs-table-bg);
    border-bottom-width: 1px;
    box-shadow: inset 0 0 0 9999px var(--bs-table-accent-bg);
}

.avatar-sm {
    height: 2rem;
    width: 2rem;
}
.rounded-circle {
    border-radius: 50%!important;
}
.me-2 {
    margin-right: 0.5rem!important;
}
img, svg {
    vertical-align: middle;
}

a {
    color: #3b76e1;
    text-decoration: none;
}

.badge-soft-danger {
    color: #f56e6e !important;
    background-color: rgba(245,110,110,.1);
}
.badge-soft-success {
    color: #63ad6f !important;
    background-color: rgba(99,173,111,.1);
}

.badge-soft-primary {
    color: #3b76e1 !important;
    background-color: rgba(59,118,225,.1);
}

.badge-soft-info {
    color: #57c9eb !important;
    background-color: rgba(87,201,235,.1);
}

.avatar-title {
    align-items: center;
    background-color: #3b76e1;
    color: #fff;
    display: flex;
    font-weight: 500;
    height: 100%;
    justify-content: center;
    width: 100%;
}
.bg-soft-primary {
    background-color: rgba(59,118,225,.25)!important;
}
</style>
