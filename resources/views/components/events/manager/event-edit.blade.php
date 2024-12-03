<div class="show-event-container">
    <h1>Editar {{ $event->name }}</h1>
    <div class="linha-divisoria-event-manager"></div>
    <form  method="POST" action="{{ url('/events/'.$event->id) }}" enctype="multipart/form-data" class="show-event-form">
        @method('PUT')
        @csrf
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
        <div class="grid-form">
            <div class="event-name">
                <label for="name">Nome do Evento</label>
                <input type="text"name="name" id="name" value="{{ $event->name }}"  class="form-control">
            </div>
            <div class="event-local">
                <label for="localization">Localização</label>
                <input type="text" class="form-control" name="localization"  id="localization" value="{{ $event->localization }}">
            </div>
            <div class="event-participants">
                <label for="number_of_participants">Participantes</label>
                <input type="text" class="form-control" name="number_of_participants"  id="number_of_participants" 
                value="{{ $event->number_of_participants }}" min="30" max="100000" 
                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
            </div>
            <div class="event-description">
                <label for="description">Descrição do Evento</label>
                <input type="text-area" class="form-control" name="description"  id="description"  value="{{ $event->description }}">
            </div>
            <div class="event-category">
                <label for="category_id">Categoria</label>
                <select id="category_id" name="category_id"  class="form-control">
                    <option  >Selecione a categoria:</option>
                    @foreach ($categories as $item)
                    <option value="{{ $item->id }}" @if( $item->id == $event->category_id) selected @endif >{{ $item->description }}</option>
                        @endforeach
                </select>  
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
            <div>
                <label for="start_date">Data do Evento</label>
                <input type="date" class="form-control" name="start_date" id="start_date" value="{{ $event->start_date }}">
            </div>
            <div>
                <label for="start_time">Hora</label>
                <input type="time" class="form-control" name="start_time" id="start_time"  value="{{ date('H:i', strtotime($event->start_time)) }}"  pattern="^([01][0-9]|2[0-3]):[0-5][0-9]$"  placeholder="HH:MM">
            </div>
            <div>
                <label for="end_date">Data do Fim do Evento</label>
                <input type="date" class="form-control" name="end_date" id="end_date" value="{{ $event->end_date }}">
            </div>
            <div>
                <label for="end_time">Hora</label>
                <input type="time" class="form-control" name="end_time" id="end_time"  value="{{ date('H:i', strtotime($event->end_time)) }}" pattern="^([01][0-9]|2[0-3]):[0-5][0-9]$"   placeholder="HH:MM">
            </div>
            <div>
                <label for="number_of_participants">Custo do Evento</label>
                <input type="text" class="form-control" name="amount"  id="amount" value="{{ $event->amount }}" 
                min="30" max="1000000" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" 
                step="0.01" min="0" >
            </div>
            <div>
                <label for="ticket_amount">Custo do Bihete (Quando Aplicável)</label>
                <input type="text" class="form-control" name="ticket_amount"  id="ticket_amount" value="{{ $event->ticket_amount }}" 
                min="30" max="1000000" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" 
                step="0.01" min="0" >
            </div>
        </div>
        <div class="edit-supplier-btn">
            <a href="{{ url('/events/manager/'.$event->id).'/supplier' }}" class="update-supplier-btn">Gerir Fornecedores</a> 
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
            <a href="/events/manager" class="go-back-btn">Voltar à lista de eventos</a>
            <button type="submit" class="update-event-btn">Atualizar Evento</button>  
        </div>
    </form>
</div>
