<div class="show-event-container">
    <h1>Editar {{ $event->name }}</h1>
    <div class="linha-divisoria-event-manager"></div>

    <form  method="POST" action="{{ url('/events/'.$event->id) }}" enctype="multipart/form-data" class="show-event-form">
        @method('PUT')
        @csrf
        @if( $event->image )
        <div class="show-event-image">
            <img src="/images/{{ $event->image }}" alt="Imagem do Evento">
        </div>
        <div class="custom-file">              
                <label for="image">Imagem:</label>
                <input  type="file" id="image" name="image" class="form-control @error('image') is-invalid @enderror"> 
                @error('image')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror               
            </div> 
        @else    
            <img src="/images/noimage_default.jpg" alt="...">
            <div class="custom-file">              
                <label for="image">Imagem:</label>
                <input  type="file" id="image" name="image" class="form-control @error('image') is-invalid @enderror"> 
                @error('image')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror               
            </div> 
        @endif 

        <div class="grid-form">
            <div class="event-name">
                <label for="inputEmail4">Nome do Evento</label> 
                <input type="text" name="name" id="name" value="{{ $event->name }}" placeholder="Nome do Evento" class="form-control @error('localization') is-invalid @enderror"  >
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>   
            <div class="event-local">
                <label for="inputlocalization">Localização</label>
                <input type="text" class="form-control @error('localization') is-invalid @enderror" name="localization"  id="localization" value="{{ $event->localization }}" placeholder="Localização do evento"  >
                @error('localization')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="event-participants">
                <label for="number_of_participants">Nº de Participantes</label>
                <input type="text" class="form-control @error('number_of_participants') is-invalid @enderror" name="number_of_participants"  id="number_of_participants" value="{{ $event->number_of_participants  }}" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  >
                @error('number_of_participants')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="event-description">
                <label for="inputAddress">Descrição do Evento</label>
                <input type="text-area" class="form-control @error('description') is-invalid @enderror" name="description"  id="description" placeholder="Descrição do evento" value="{{ $event->description }}"  >
                @error('description')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="event-category">               
                <label class="" for="inputGroupSelect01">Categoria</label>
                <select id="type" name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror"  >
                    <option disabled>Selecione a categoria:</option>
                    @foreach ($categories as $item)
                        <option value="{{ $item->id }}" @if( $item->id == $event->category_id) selected @endif >{{ $item->description }}</option>
                    @endforeach
                </select>  
                @error('category_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror     
            </div>        
            <div class="start_date">
                <label for="inputAddress2">Data Inicio do Evento</label>
                <input type="date" class="form-control @error('start_date') is-invalid @enderror" name="start_date" id="start_date" value="{{ $event->start_date  }}" min="{{ now()->toDateString() }}"   >
                @error('start_date')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="start_time">
                <label for="inputAddress2">Hora Inicio do Evento</label>
                <input type="time" class="form-control @error('start_time') is-invalid @enderror" name="start_time" id="start_time" 
                value="{{ date('H:i', strtotime($event->start_time)) }}"    pattern="^([01][0-9]|2[0-3]):[0-5][0-9]$"  placeholder="HH:MM" >
                @error('start_time')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="end_date">
                <label for="inputAddress2">Data Fim do Evento</label>
                <input type="date" class="form-control @error('end_date') is-invalid @enderror" name="end_date" id="end_date" value="{{ $event->end_date  }}"  min="{{ now()->toDateString() }}"   >
                @error('end_date')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="end_time">
                <label for="inputAddress2">Hora Fim do Evento</label>
                <input type="time" class="form-control @error('end_time') is-invalid @enderror" name="end_time" id="end_time" value="{{ date('H:i', strtotime($event->end_time)) }}"
                pattern="^([01][0-9]|2[0-3]):[0-5][0-9]$" 
                placeholder="HH:MM" >
                @error('end_time')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="event-type">
                <label for="inputState">Tipo de Evento</label>
                <select id="type" name="type"  class="form-control @error('type') is-invalid @enderror"  >
                    <option disabled>Escolher o tipo de evento...</option>
                    <option value="Publico" @if($event->type == "Publico") selected @endif >Público</option>
                    <option value="Privado" @if($event->type == "Privado") selected @endif >Privado</option>
                </select>
                @error('type')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
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
                        @endif>
                        <label for="suppliers[]">{{ $type->name }}</label>
                </div>
                @endforeach
        </div>
    <div class="edit-event-back-btn">
        <a href="/events/owner" class="go-back-btn">Voltar à lista de eventos</a>
        <button type="submit" class="update-event-btn">Atualizar Evento</button>  
    </div>
    </form>
</div>

@vite('resources/js/form-create-event.js')