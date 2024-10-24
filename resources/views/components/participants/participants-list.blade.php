@if (session('status'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('status') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

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
      <th scope="col">Presença Confirmada?</th>
      <th scope="col">Ações</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($participants as $participant)
    <tr>
      <td>{{$participant->name}}</td>
      <td>{{$participant->phone}}</td>
      <td>{{$participant->confirmation}}</td>
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



