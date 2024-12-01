<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<div class="container-show-event">
    <div class="wrapper-show-event">
        <div class="show-event-heading">
            <h1>Evento</h1>
        </div>
        <br>

        <form  method="POST" action="{{ url('/events/'.$event->id) }}" enctype="multipart/form-data" class="mt-2">
            @method('PUT')
            @csrf

            <div class="card" style="width: 18rem;">
                <img src="/images/{{ $event->image }}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h3>{{ $event->name }}</h3>
                    <p class="card-text">{{ $event->localization }} - {{ $event->start_date }}</p>
                </div>
                <div>
                <a href="{{ url('/events/manager/'.$event->id).'/supplier' }}" class="go-back-btn">Gerir Fornecedores</a> 
                </div>
            </div>
    

            <div class="form-row">
                <div class="form-group">
                <label for="inputEmail4">Nome do Evento</label> 
                <input type="text"name="name" id="name" value="{{ $event->name }}"  class="form-control"  >
                </div>

                <div class="form-group">
                <label for="inputlocalization">Localização</label>
                <input type="text" class="form-control" name="localization"  id="localization" value="{{ $event->localization }}"   >
                </div>

                <div class="form-group">
                <label for="number_of_participants">Participantes</label>
                <input type="text" class="form-control" name="number_of_participants"  id="number_of_participants" value="{{ $event->number_of_participants }}" min="30" max="100000" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"  >
                </div>
            </div>

            <div class="form-row">
                
                <div class="form-group">
                    <label for="inputAddress">Descrição do Evento</label>
                    <input type="text-area" class="form-control" name="description"  id="description"  value="{{ $event->description }}"  >
                </div>

                <div class="form-group">               
                    <label class="" for="inputGroupSelect01">Categoria</label>
                    <select id="category_id" name="category_id"  class="form-control"  >
                        <option  >Selecione a categoria:</option>
                        @foreach ($categories as $item)
                        <option value="{{ $item->id }}" @if( $item->id == $event->category_id) selected @endif >{{ $item->description }}</option>
                         @endforeach
                    </select>       
                </div>

                <div class="form-group">
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
            
            <div class="form-row">
                <div class="form-group">
                    <label for="start_date">Data do Evento</label>
                    <input type="date" class="form-control" name="start_date" id="start_date" value="{{ $event->start_date }}"  >
                </div>
                <div class="form-group">
                    <label for="start_time">Hora</label>
                    <input type="time" class="form-control" name="start_time" id="start_time"  value="{{ date('H:i', strtotime($event->start_time)) }}"  pattern="^([01][0-9]|2[0-3]):[0-5][0-9]$"  placeholder="HH:MM"    >
                </div>

                <div class="form-group">
                    <label for="end_date">Data do Fim</label>
                    <input type="date" class="form-control" name="end_date" id="end_date" value="{{ $event->end_date }}">
                </div>
                <div class="form-group">
                    <label for="end_time">Hora</label>
                    <input type="time" class="form-control" name="end_time" id="end_time"  value="{{ date('H:i', strtotime($event->end_time)) }}" pattern="^([01][0-9]|2[0-3]):[0-5][0-9]$"   placeholder="HH:MM"   >
                </div>
            </div>    
 
            @php
                $servicesArray = json_decode($event->services_default_array, true);
            @endphp

            @foreach($SupplierType as $type)

                @if( ( $loop->iteration % 2) !== 0)
                <div class="">
                @endif

                <div class="">
                    <input type="checkbox" id="suppliers[]" name="suppliers[]" value="{{$type->id}}" 
                
                    @if(!empty($servicesArray) && in_array($type->id, $servicesArray))
                        checked
                    @endif
                    > {{  $type->name }}              
                </div>

                @if( ( $loop->iteration % 2) === 0)
                </div>
                @endif

            @endforeach   
  
            </br>
            </br>

            <div class="form-row">
            
                <div class="form-group">
                    <label for="number_of_participants">Custo do Evento</label>
                    <input type="text" class="form-control" name="amount"  id="amount" value="{{ $event->amount }}" min="30" max="1000000" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" step="0.01" min="0" >
                </div>


                <div class="form-group">
                    <label for="ticket_amount">Custo do Bihete (Quando Aplicável)</label>
                    <input type="text" class="form-control" name="ticket_amount"  id="ticket_amount" value="{{ $event->ticket_amount }}" min="30" max="1000000" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" step="0.01" min="0" >
                </div>
            </div>

            <div class="input-group mt-3">          
                <div class="custom-file">              
                    <label for="image">Imagem:</label>
                    <input  type="file" id="image" name="image" class="form-control @error('image') is-invalid @enderror"> 
                    @error('image')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror               
                </div>     
            </div> 

            <div>
                <a href="/events/manager" class="go-back-btn">Voltar a lista de eventos</a> 
                <button type="submit" class="btn btn-success mt-5 mb-5">Atualizar Evento</button>  
                    
            </div>
        </form>
    </div>
</div>