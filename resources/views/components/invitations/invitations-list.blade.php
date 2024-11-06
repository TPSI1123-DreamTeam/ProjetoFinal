@if (session('status'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('status') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif


<h1>Lista de Convites</h1>

<form method="POST" action="{{ url('/invitations') }}">
    @csrf
    @method('DELETE')
 <button type="submit" class="btn btn-danger">Delete All</button>
</form>&nbsp;
<table class="table">
  <thead>
    <tr>
      <th scope="col">Tema</th>
      <th scope="col">Descrição do evento</th>
      <th scope="col">Imagem</th>
      <th scope="col">Data do evento</th>
      <th scope="col">Local do evento</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($invitations as $invitation)
    <tr>
      <td>{{$invitation->title}}</td>
      <td>{{$invitation->body}}</td>
      <img src="{{ asset($invitation->image) }}">
      <td>{{$invitation->date}}</td>
      <td>{{$invitation->place}}</td>
      <td style="width:210px;">{{$invitation->actions}}
        <div class="pr-1">
            <a href="{{url('invitations/' . $invitation->id)}}" type="button"
            class="btn btn-success" style="background-color: green; float:left">Mostrar</a>
            </div>
        <div class="pr-1">
            <a href="{{url('invitations/' . $invitation->id . '/edit')}}" type="button"
            class="btn btn-success" style="background-color: blue; float:center">Editar</a>
            </div>
            <form method="POST" action="{{ url('invitations/' . $invitation->id) }}">
                @csrf
                @method('DELETE')
             <button type="submit" class="btn btn-danger">Apagar</button>
            </form>
      </td>

    </tr>
    @endforeach

  </tbody>
</table>

{{ $invitations->links() }}



