@if (session('status'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('status') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif


<h1>Lista de Convites</h1>

<form method="POST" action="{{ url('/categories') }}">
    @csrf
    @method('DELETE')
 <button type="submit" class="btn btn-danger">Delete All</button>
</form>&nbsp;
<table class="table">
  <thead>
    <tr>
      <th scope="col">Descrição</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($categories as $category)
    <tr>
      <td>{{$category->description}}</td>
      <td style="width:210px;">{{$category->actions}}
        <div class="pr-1">
            <a href="{{url('categories/' . $category->id)}}" type="button"
            class="btn btn-success" style=" float:left">Mostrar</a>
            </div>
            <br>
        <div class="pr-1">
            <a href="{{url('categories/' . $category->id . '/edit')}}" type="button"
            class="btn btn-success" style=" float:center">Editar</a>
            </div>

            <form method="POST" action="{{ url('categories/' . $category->id) }}">
                @csrf
                @method('DELETE')
             <button type="submit" class="btn btn-danger">Apagar</button>
            </form>
      </td>

    </tr>
    @endforeach

  </tbody>
</table>

{{ $categories->links() }}

@vite('resources/js/orderTable.js')
