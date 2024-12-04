


<h1>Lista de Convites</h1>

<div class="d-flex flex-wrap align-items-center justify-content-end gap-2 mb-3">
    <div class="col-md-6 ">
      <div class="form-group">
        <form action="/findEventInvitation" method="POST">
          @csrf
          <div class="input-group">
            <select class="form-control" id="search" name="search">
              <option selected>Escolha o evento para listar participantes...</option>
              @foreach ($events as $event)
              <option value="{{ $event->id }}" {{ request()->input('search') == $event->id ? 'selected' :'' }}>{{ $event->name }}</option>
              @endforeach
              {{-- <input  id="selected-event-id" name="event_id" value="{{$event->id}}"/> --}}
            </select>
            <button type="submit" class="btn btn-primary" >Search</button>
          </div>
        </form>
      </div>
    </div>
</div>
<span>Id do evento: {{ $trueId }}</span>

    @if ( $invitation != null)

    <p>Convite:</p>
        <p> {{ $invitation->title }}</p>
        <img src="{{ $invitation->image }}">
    @else
        <p>Sem convite associado</p>
        <div>
            <form action="{{ url('invitations/' . $trueId .'/create') }}" method="GET">
                <button type="submit" class="btn btn-primary">
                    <input hidden name="event" value="{{ $trueId }}">
                    <p>Criar Convite</p>
                </button>
            </form>
    </div>
    @endif



@if ($invitation)
<div>
        <form action="{{ url('invitations/' . $invitation->id .'/submit') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary" style="border-color: blue">
                <input hidden name="event" value="{{ $trueId }}">
                <p>Enviar Convite</p>
            </button>
        </form>

</div>
@endif



