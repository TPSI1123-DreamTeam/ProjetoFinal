
<div class="event-wrapper-participant">
    <h1 class="part-list-title">Lista de Participantes</h1>
</div>
<div class="linha-divisoria-participant-list"></div>

<form action="/searchEvents" method="POST">
    @csrf
    <div class="search-filter-export">
        <select class="choose-event" id="search" name="search">
            <option selected>Escolha o evento para listar participantes...</option>
            @foreach ($events as $event)
                <option value="{{ $event->id }}" {{ request()->input('search') == $event->id ? 'selected' :'' }}>{{ $event->name }}</option>
            @endforeach
        </select>
        <button class="search-participant-btn" type="submit">Search</button>
        @if(isset($participants) && $participants->users && $participants->users->isNotEmpty())
            <form>
                <a class="export-btn" href="{{url('participants/export/' . $participants->id)}}">Export</a>
            </form>
        @endif
        @if(isset($participants) && $participants->users->isEmpty())
        <form method="POST" action="{{url('participants/import/' . $event->id )}}" enctype="multipart/form-data">
                @csrf
                <div>
                    <label>Escolher Ficheiross:</label>
                    <input type="file" id="ExcelFile" name="file">
                    <input hidden name="event" value="{{ $event->id }}">
                </div>
                <div>
                    <button>Submeter</button>
                </div>
            </form>
        @endif
    </div>
    <div class="selected-event-info">
        <h5>Participantes no Evento Selecionado<span>
        @if(isset($participants) && $participants->users && $participants->users->isNotEmpty() && isset($participants->users))
            ({{ count($participants->users) }})
        @else
            (0)
        @endif
        </span></h5>
        <h6>
        @if(isset($participants) && $participants->users && $participants->users->isNotEmpty())
            <span>Data:</span> {{ $participants->start_date }} <span>Hora:</span> {{ date('H:i', strtotime($participants->start_time)) }}
        @endif
    </div>
</form>

<table class="participant-list-table">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Contacto</th>
            <th>Email</th>
            <th>Confirmação</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody class="participant-list-table">
        <?php $emailsArray = []; ?>
        @if( !empty($participants) )
        @foreach ($participants->users as $participant)
        <tr>
            <td data-cell="nrº">{{ $loop->iteration }}</td>
            <td data-cell="nome">{{$participant->name}}</td>
            <td data-cell="contacto"><span class="badge badge-soft-success mb-0">{{$participant->phone}}</span></td>
            <td data-cell="email">{{$participant->email}} <?php $emailsArray = $participant->email ?></td>
            <td data-cell="confirmado">@if ($participant->pivot->confirmation) Sim @else Não  @endif</td>
            <td data-cell="ações">
                <div class="action-buttons-participants">
                    <form action="{{ url('participants/' . $participant->id . '/editState') }}" method="GET">
                        <button type="submit" class="edit-participant-btn">
                            <input hidden name="user" value="{{ $participant->id }}">
                            <input hidden name="event" value="{{ $trueId }}">
                            <input hidden name="confirmation" value="{{ $participant->pivot->confirmation }}">
                            <i class="bx bx-pencil"></i>
                        </button>
                    </form>
                    <form action="{{ url('participants/' . $participant->id . '/detachParticipant') }}" method="GET">
                        <button type="submit" class="remove-participant-btn">
                            <input hidden name="user" value="{{ $participant->id }}">
                            <input hidden name="event" value="{{ $trueId }}">
                            <input hidden name="confirmation" value="{{ $participant->pivot->confirmation }}">
                            <i class="bx bx-trash-alt"></i>
                        </button>
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
        @endif
    </tbody>
</table>

@vite('resources/js/orderTable.js')
