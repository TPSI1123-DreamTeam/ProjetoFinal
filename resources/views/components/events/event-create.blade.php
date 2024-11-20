<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<div class="container">
    <div class="d-flex align-items-center mt-5">
        <h1>Formulário para o seu evento</h1>   
    </div>
    <br>
    <!-- RECEBE A CATEGORIA SELECIONADA NO ECRA ANTERIOR -->
    <form  method="POST" action="{{ url('/events') }}" enctype="multipart/form-data" class="mt-2">
        @csrf

        <div class="form-row">
            <div class="form-group col-md-6">
            <label for="inputEmail4">Nome do Evento</label> 
            <input type="text" class="form-control" name="name" id="name" placeholder="Nome do Evento" required>
            <input type="hidden" name="owner_id"    id="owner_id" value="{{ Auth::User()->id }}" >
            <input type="hidden" name="category_id" id="category_id" value="{{ $category->id }}" >
            <input type="hidden" name="amount"  id="amount" value="0" >
            <input type="hidden" name="event_confirmation"  id="event_confirmation" value="0" >
            </div>
            <div class="form-group col-md-4">
            <label for="inputlocalization">Localização</label>
            <input type="text" class="form-control" name="localization"  id="localization" value="{{ old('localization') }}" placeholder="Localização do evento" required>
            </div>

            <div class="form-group col-md-2">
            <label for="number_of_participants">Nº de Participantes</label>
            <input type="number" class="form-control" name="number_of_participants"  id="number_of_participants" value="{{ old('number_of_participants') }}" min="30" max="100000" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-7">
                <label for="inputAddress">Descrição do Evento</label>
                <input type="text-area" class="form-control" name="description"  id="description" placeholder="Breve descrição para ser apresentada no portal" value="{{ old('description') }}" required>
            </div>

             <div class="form-group col-md-5">               
                <label class="" for="inputGroupSelect01">Categoria</label>
                <select id="type" name="type"  class="form-control" required>
                    <option disabled>Selecione a categoria:</option>
                    @foreach ($categories as $item)
                        <option value="{{ $item->id }}" @if( $item->id == $category->id) selected @endif >{{ $item->description }}</option>
                    @endforeach
                </select>       
              </div>
        </div>
        
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="inputAddress2">Data Inicio do Evento</label>
                <input type="date" class="form-control" name="start_date" id="start_date" value="{{ old('start_date') }}"  placeholder="" required>
            </div>
            <div class="form-group col-md-2">
                <label for="inputAddress2">Hora Inicio do Evento</label>
                <input type="time" class="form-control" name="start_time" id="start_time" value="{{ old('start_time') }}" placeholder="" required>
            </div>

            <div class="form-group col-md-4">
                <label for="inputAddress2">Data Fim do Evento</label>
                <input type="date" class="form-control" name="end_date" id="end_date" value="{{ old('end_date') }}"  placeholder="" required>
            </div>
            <div class="form-group col-md-2">
                <label for="inputAddress2">Hora Fim do Evento</label>
                <input type="time" class="form-control" name="end_time" id="end_time" value="{{ old('end_time') }}"  placeholder="" required>
            </div>
        </div>

        <div class="form-group">
            <label for="inputState">Tipo de Evento</label>
            <select id="type" name="type"  class="form-control" required>
                <option disabled>Escolher o tipo de evento...</option>
                <option value="Publico">Público</option>
                <option value="Privado">Privado</option>
            </select>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <input type="checkbox" id="suppliers[]" name="suppliers[]" value="1"> Locação de espaços
            </div>
            <div class="form-group col-md-6">
                <input type="checkbox" id="suppliers[]" name="suppliers[]" value="2"> Catering
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <input type="checkbox" id="suppliers[]" name="suppliers[]" value="3"> Decoração
            </div>
            <div class="form-group col-md-6">
                <input type="checkbox" id="suppliers[]" name="suppliers[]" value="4"> Entretenimento
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <input type="checkbox" id="suppliers[]" name="suppliers[]" value="5"> Serviços técnicos
            </div>
            <div class="form-group col-md-6">
                <input type="checkbox" id="suppliers[]" name="suppliers[]" value="6"> Produção e logística
            </div>
        </div>  


        <!-- <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <label class="input-group-text" for="inputGroupSelect01">Serviços</label>
                </div>
                <select class="custom-select"
                    id="actor_movie"
                    name="actor_movie[]"
                    multiple>
                    <option disabled>Selecione os Serviços:</option>
                    @foreach ($suppliers as $supplier)
                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                    @endforeach
                  </select>                
              </div>
  -->

        <div class="input-group mb-3 mt-2">
            <!-- <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
            </div> -->
            <div class="custom-file">
                <!-- <input type="file" class="custom-file-input" id="image" name="image" >
                <label class="custom-file-label" for="image"> </label> -->
            <!-- </div> -->

            <!-- <label for="phone">Imagem do Convite</label> -->
            <label>Escolher Imagem:</label>
            <input
            type="file"
            id="image"
            name="image"
            autocomplete="image"
            placeholder=" "
            class="form-control
            @error('image') is-invalid @enderror"
            value="{{ old('image') }}"
            required
            aria-describedby="imageHelp"
            value="test">
            <small id="imageHelp" class="form-text text-muted"></small>
            @error('image')
            <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
            </span>
            @enderror
            </div>
     
        </div>



        <br>
        <button type="submit" class="btn btn-success">Registar Evento</button>
        <br>

    </form>
    <br>
    <br>
    <br>
</div>


