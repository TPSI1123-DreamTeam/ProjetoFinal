<div class="event-wrapper">
    <div class="title-hidder-div">
        <h1>Lista de Convites</h1>
    </div>
</div>
<div class="linha-divisoria-event-manager"></div>


<form action="/findEventInvitation" method="POST" class="invitation-form">
    @csrf
    <div class="select-input-btn-inv">
        <select id="search" name="search" class="custom-select">
            <option selected>Escolha o evento para listar participantes...</option>
            @foreach ($events as $event)
                <option value="{{ $event->id }}" {{ request()->input('search') == $event->id ? 'selected' : '' }}>{{ $event->name }}</option>
            @endforeach
        </select>
        <input id="selected-event-id" name="event_id" value="{{ $event->id }}" hidden />
        <button type="submit" class="search-btn-inv">Procurar</button>
    </div>
</form>



@if ( $trueId == 0)
    <div class="nill-event">
        <p>Por favor selecione um evento</p>
    </div>
@else
    @if ( $invitation != null)
        <p>Convite:</p>
        <p> {{ $invitation->title }}</p>
        <img src="{{ asset($invitation->image) }}">
        <form action="{{ url('invitations/' . $invitation->id .'/submit') }}" method="POST">
            @csrf
            <button type="submit" class="int-send-btn">
                <input hidden name="event" value="{{ $trueId }}">
                Enviar Convite
            </button>
        </form>
    @else
        <div class="no-invitation-added">
            <span>Sem convite associado</span>
        </div>
        <div class="eventId-notNill">
            <form action="{{ url('invitations/' . $trueId .'/create') }}" method="GET">
                <button type="submit" class="create-inv-btn">
                    <input hidden name="event" value="{{ $trueId }}">
                    Criar Convite
                </button>
            </form>
        </div>
    @endif
@endif

