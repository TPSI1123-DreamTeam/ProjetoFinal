<div class="show-event-container">
    <h1>{{ $event->name }}</h1>
    <div class="linha-divisoria-event-manager"></div>
    <form method="POST" action="{{ url('/events') }}" enctype="multipart/form-data" class="show-event-form">
        @csrf
        <div class="show-event-image">
            <img src="/images/{{ $event->image }}" alt="Imagem do Evento">
        </div>
        <div class="grid-form">
            <div class="event-name">
                <label for="name">Nome do Evento</label>
                <input type="text" name="name" id="name" value="{{ $event->name }}" disabled>
            </div>
            <div class="event-local">
                <label for="localization">Localização</label>
                <input type="text" name="localization" id="localization" value="{{ $event->localization }}" disabled>
            </div>
            <div class="event-participants">
                <label for="number_of_participants">Participantes</label>
                <input type="text" name="number_of_participants" id="number_of_participants" 
                    value="{{ $event->number_of_participants }}" 
                    min="30" max="100000" 
                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" 
                    disabled>
            </div>
            <div class="event-description">
                <label for="description">Descrição do Evento</label>
                <textarea name="description" id="description" disabled>{{ $event->description }}</textarea>
            </div>
            <div class="event-category">
                <label for="type">Categoria</label>
                <select id="type" name="type" disabled>
                    <option disabled>Selecione a categoria:</option>
                </select>
            </div>
            <div class="event-type">
                <label for="type">Tipo de Evento</label>
                <select id="type" name="type" disabled>
                    <option disabled>Escolher o tipo de evento...</option>
                    <option value="Publico">Público</option>
                    <option value="Privado">Privado</option>
                </select>
            </div>
            <div>
                <label for="start_date">Data do Evento</label>
                <input type="date" name="start_date" id="start_date" value="{{ $event->start_date }}" disabled>
            </div>
            <div>
                <label for="start_time">Hora</label>
                <input type="time" name="start_time" id="start_time" value="{{ $event->start_time }}" disabled>
            </div>
            <div>
                <label for="end_date">Data do Fim do Evento</label>
                <input type="date" name="end_date" id="end_date" value="{{ $event->end_date }}" disabled>
            </div>
            <div>
                <label for="end_time">Hora</label>
                <input type="time" name="end_time" id="end_time" value="{{ $event->end_time }}" disabled>
            </div>
        </div>
        <div class="checkbox-group">
            @php
                $servicesArray = json_decode($event->services_default_array, true);
            @endphp

            @foreach($SupplierType as $type)
            <div class="suppliers-input">
                <input type="checkbox" id="suppliers[]" name="suppliers[]" value="{{ $type->id }}" 
                    @if(!empty($servicesArray) && in_array($type->id, $servicesArray))
                        checked
                    @endif 
                    disabled>
                    <label for="suppliers[]">{{ $type->name }}</label>
            </div>
            @endforeach
        </div>
        <div class="show-event-back-btn">
            <a href="/events/manager" class="go-back-btn">Voltar à lista de eventos</a>
        </div>
    </form>
</div>