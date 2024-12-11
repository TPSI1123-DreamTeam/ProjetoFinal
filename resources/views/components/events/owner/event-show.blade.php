<div class="show-event-container">
    <h1>{{ $event->name }}</h1>
    <div class="linha-divisoria-event-manager"></div>

    <form  method="" action="" enctype="" class="show-event-form">   
    <div class="show-event-image">
            <img src="/images/{{ $event->image }}" alt="Imagem do Evento">
        </div>
        <div class="grid-form">
            <div class="event-name">
                <label for="inputEmail4">Nome do Evento</label> 
                <input type="text" name="name" id="name" value="{{ $event->name }}" disabled>
            </div>
            <div class="event-local">
                <label for="inputlocalization">Localização</label>
                <input type="text" name="localization"  id="localization" value="{{ $event->localization }}" disabled>
            </div>
            <div class="event-participants">
                <label for="number_of_participants">Participantes</label>
                <input type="text" name="number_of_participants"  id="number_of_participants" value="{{ $event->number_of_participants }}" min="30" max="100000" 
            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" disabled>
            </div>
            <div class="event-description">
                <label for="inputAddress">Descrição do Evento</label>
                <input type="text-area" name="description"  id="description"  value="{{ $event->description }}" disabled>
            </div>
            <div class="event-category">               
                <label for="inputGroupSelect01">Categoria</label>
                <input type="text" name="category" id="category" value="{{ $category->description }}" disabled>  
            </div>
            <div class="start_date">
                <label for="inputAddress2">Data do Evento</label>
                <input type="date" class="" name="start_date" id="start_date" value="{{ $event->start_date }}" disabled>
            </div>
            <div class="start_time">
                <label for="inputAddress2">Hora</label>
                <input type="time" class="" name="start_time" id="start_time" value="{{   date('H:i', strtotime($event->start_time)) }}" disabled>
            </div>
            <div class="end_date">
                <label for="inputAddress2">Data do Fim do Vento</label>
                <input type="date" class="" name="end_date" id="end_date" value="{{ $event->end_date }}" disabled>
            </div>
            <div class="end_time">
                <label for="inputAddress2">Hora</label>
                <input type="time" class="" name="end_time" id="end_time" value="{{  date('H:i', strtotime($event->end_time)) }}" disabled>
            </div>
            <div class="email">
                <label for="contact">Contacto</label>
                <input type="email" class="" name="contact" id="contact" value="{{  $event->contact }}" disabled>
            </div>
        </div>
        <div class="event-type">
            <label for="inputState">Tipo de Evento</label>
            <input type="text" class="" name="type" id="type" value="{{ $event->type }}" disabled>        
        </div> 

        <div class="checkbox-group">
        @php
            $servicesArray = json_decode($event->services_default_array, true);
        @endphp
        @foreach($SupplierType as $type)
            @if( ( $loop->iteration % 2) !== 0)
            @endif
                <div class="suppliers-input">
                    <input disabled type="checkbox" id="suppliers[]" name="suppliers[]" value="{{$type->id}}" 
                
                    @if(!empty($servicesArray) && in_array($type->id, $servicesArray))
                        checked
                    @endif
                    > {{  $type->name }}
                </div>
            @if( ( $loop->iteration % 2) === 0)
            @endif
        @endforeach 
        </div> 
        <div class="show-event-back-btn">
            <a href="/events/owner" class="go-back-btn">Voltar à lista de eventos</a>
        </div>
    </form>  
</div>