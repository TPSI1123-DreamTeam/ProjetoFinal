<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<div class="container">
    <div class="">
        <div class="d-flex align-items-center mt-5">
            <h1>Evento</h1>   
        </div>
        <br>

        <form  method="POST" action="{{ url('/events') }}" enctype="multipart/form-data" class="mt-2">
            @csrf

            <!-- <div class="card mb-3">
                <img src="/images/{{ $event->image }}" class="card-img-top" alt="..." style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">{{ $event->name }}</h5>
                    <p class="card-text">{{ $event->description }}</p>
                    <p class="card-text"><small class="text-muted">{{ $event->localization }}</small></p>
                </div>
            </div> -->

    

            <div class="form-row">
                <div class="form-group col-md-6">
                <label for="inputEmail4">Nome do Evento</label> 
                <input type="text"name="name" id="name" value="{{ $event->name }}"  class="form-control" disabled>
                </div>

                <div class="form-group col-md-4">
                <label for="inputlocalization">Localização</label>
                <input type="text" class="form-control" name="localization"  id="localization" value="{{ $event->localization }}"  disabled>
                </div>

                <div class="form-group col-md-2">
                <label for="number_of_participants">Participantes</label>
                <input type="text" class="form-control" name="number_of_participants"  id="number_of_participants" value="{{ $event->number_of_participants }}" min="30" max="100000" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" disabled>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-7">
                    <label for="inputAddress">Descrição do Evento</label>
                    <input type="text-area" class="form-control" name="description"  id="description"  value="{{ $event->description }}" disabled>
                </div>

                <div class="form-group col-md-5">               
                    <label class="" for="inputGroupSelect01">Categoria</label>
                    <select id="type" name="type"  class="form-control" disabled>
                        <option disabled>Selecione a categoria:</option>
                    
                    </select>       
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="inputAddress2">Data do Evento</label>
                    <input type="date" class="form-control" name="start_date" id="start_date" value="{{ $event->start_date }}" disabled>
                </div>
                <div class="form-group col-md-2">
                    <label for="inputAddress2">Hora</label>
                    <input type="time" class="form-control" name="start_time" id="start_time" value="{{   $event->start_time }}"   disabled>
                </div>

                <div class="form-group col-md-4">
                    <label for="inputAddress2">Data do Fim do Vento</label>
                    <input type="date" class="form-control" name="end_date" id="end_date" value="{{   $event->end_date }}"    disabled>
                </div>
                <div class="form-group col-md-2">
                    <label for="inputAddress2">Hora</label>
                    <input type="time" class="form-control" name="end_time" id="end_time" value="{{   $event->end_time }}"    disabled>
                </div>
            </div>

            <div class="form-group">
                <label for="inputState">Tipo de Evento</label>
                <select id="type" name="type"  class="form-control" disabled>
                    <option disabled>Escolher o tipo de evento...</option>
                    <option value="Publico">Público</option>
                    <option value="Privado">Privado</option>
                </select>
            </div>

            <div class="card" style="width: 18rem;">
                <img src="/images/{{ $event->image }}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h3>{{ $event->name }}</h3>
                    <p class="card-text">{{ $event->localization }} - {{ $event->start_date }}</p>
                </div>
            </div>

            <div>
            <a href="/events/owner"> <button type="button" class="btn btn-primary mt-5">Voltar a lista de eventos</button></a>   
            </div>
        </form>
    </div>
</div>