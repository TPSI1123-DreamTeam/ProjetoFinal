@if (session('status'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('status') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<form class="form-inline my-2 my-lg-0">
    <a class="nav-link" href="{{url('participants/export')}}">Export</a>
    <!--  <a class="nav-link" href="{{url('participants/import')}}">Import</a>  -->
  </form>

<form method="POST" action="{{url('participants/import')}}" enctype="multipart/form-data">
    @csrf
   <div class="mt-2">
    <label>Escolher Ficheiro:</label>
    <input type="file" name="file" class="form-control">
   </div>
   <div class="mt-2">
    <button class="btn btn-success">Submeter</button>
   </div>
</form>

<div hidden class="modal fade" id="listModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Bem Vindo!</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p> Text body here! </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>


<h1>Lista de Participantes</h1>
<form method="POST" action="{{ url('/participants') }}">
    @csrf
    @method('DELETE')
 <button type="submit" class="btn btn-danger">Delete All</button>
</form>
<table class="table">
  <thead>
    <tr>
      <th scope="col">Nome</th>
      <th scope="col">Nº Telemóvel</th>
      <th scope="col">Email</th>
      <th scope="col">Presença Confirmada?</th>
      <th scope="col">Ações</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($participants as $participant)
    <tr>
        {{-- {{$participant}} --}}
      <td>{{$participant->name}}</td>
      <td>{{$participant->phone}}</td>
      <td>{{$participant->email}}</td>
      {{-- <td>@if ($participant->confirmation) Sim @else Não @endif --}}
       <td> {{$participant->events}}

      </td>
      <td style="width:210px;">{{$participant->actions}}
        <div class="pr-1">
            <a href="{{url('participants/' . $participant->id)}}" type="button"
            class="btn btn-success" style="background-color: green; float:left">Mostrar</a>
            </div>
        <div class="pr-1">
            <a href="{{url('participants/' . $participant->id . '/edit')}}" type="button"
            class="btn btn-success" style="background-color: blue; float:center">Editar</a>
            </div>
            <form method="POST" action="{{ url('participants/' . $participant->id) }}">
                @csrf
                @method('DELETE')
             <button type="submit" class="btn btn-danger">Apagar</button>
            </form>
      </td>

    </tr>
    @endforeach

  </tbody>
</table>

{{ $participants->links() }}



