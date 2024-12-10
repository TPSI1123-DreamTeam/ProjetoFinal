<div class="event-wrapper">
    <div class="title-hidder-div">
        <h1>Lista de Convites</h1>
    </div>
</div>
<div class="linha-divisoria-event-manager"></div>

@if(session('status'))
            <div id="success-notification" class="fixed bottom-4 right-4 bg-green-500 text-white p-4 rounded-lg shadow-lg opacity-0 transform transition-all duration-300 z-50">
                {{ session('status') }}
            </div>
        @endif


        @if(session('error'))
            <div id="success-notification" class="fixed bottom-4 right-4 bg-red-500 text-white p-4 rounded-lg shadow-lg opacity-0 transform transition-all duration-300 z-50">
                {{ session('error') }}
            </div>
        @endif


        @if(session('warning'))
            <div id="success-notification" class="fixed bottom-4 right-4 bg-yellow-500 text-white p-4 rounded-lg shadow-lg opacity-0 transform transition-all duration-300 z-50">
                {{ session('warning') }}
            </div>
        @endif

<form action="/findEventInvitation" method="POST" class="invitation-form">
    @csrf
    <div class="select-input-btn-inv">
        <select id="search" name="search" class="custom-select">
            @if ($trueId == 0)
            <option selected>Escolha o evento para listar participantes...</option>
            @foreach ($events as $event)
                <option value="{{ $event->id }}" {{ request()->input('search') == $event->id ? 'selected' : '' }}>{{ $event->name }}</option>
            @endforeach
            @else

            @foreach ($events as $event)
                <option value="{{ $event->id }}" {{ request()->input('search') == $event->id ? 'selected' : '' }}>{{ $event->name }}</option>
            @endforeach
            @endif
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
    @if ( $invitation !== null)
        <p>Convite:</p>
        <p> {{ $invitation->title }}</p>
        @php
            $filePath = $invitation->image;
            $filePath = str_replace('C:\Users\eu\Documents\ProjetoFinal\public\\', '', $filePath);
            $filePath = str_replace('\\', '/', $filePath);
        @endphp
        <img src="/{{$filePath}}" >
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

<script>
    window.addEventListener('DOMContentLoaded', () => {
        const successNotification = document.getElementById('success-notification');

        if (successNotification) {
            setTimeout(() => {
                successNotification.classList.remove('opacity-0');
                successNotification.classList.add('opacity-100');
            }, 100);

            setTimeout(() => {
                successNotification.classList.remove('opacity-100');
                successNotification.classList.add('opacity-0');
            }, 3000);
        }
    });
</script>

