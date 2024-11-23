<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

@vite('resources/js/form-create-event.js')

<div class="container">
    <div class="d-flex align-items-center mt-5">
        <h1>Formulário para o evento</h1>   
    </div>
    <br>

    <form  method="POST" action="{{ url('/events') }}" enctype="multipart/form-data" class="mt-2">
        @csrf

        <div class="form-row">

            <div class="form-group col-md-6">
                <label for="inputEmail4">Nome do Evento</label> 
                <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="Nome do Evento" class="form-control @error('localization') is-invalid @enderror" required>
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>   

            <div class="form-group col-md-4">
                <label for="inputlocalization">Localização</label>
                <input type="text" class="form-control @error('localization') is-invalid @enderror" name="localization"  id="localization" value="{{ old('localization') }}" placeholder="Localização do evento" required>
                @error('localization')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group col-md-2">
                <label for="number_of_participants">Nº de Participantes</label>
                <input type="text" class="form-control @error('number_of_participants') is-invalid @enderror" name="number_of_participants"  id="number_of_participants" value="{{ old('number_of_participants') }}" oninput="this.value = this.value.replace(/[^0-9]/g, '');" required>
                @error('number_of_participants')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-7">
                <label for="inputAddress">Descrição do Evento</label>
                <input type="text-area" class="form-control @error('description') is-invalid @enderror" name="description"  id="description" placeholder="Descrição do evento" value="{{ old('description') }}" required>
                @error('description')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group col-md-5">               
                <label class="" for="inputGroupSelect01">Categoria</label>
                <select id="type" name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror" required>
                    <option disabled>Selecione a categoria:</option>
                    @foreach ($categories as $item)
                        <option value="{{ $item->id }}" @if( $item->id == $category->id) selected @endif >{{ $item->description }}</option>
                    @endforeach
                </select>  
                @error('category_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror     
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="inputAddress2">Data Inicio do Evento</label>
                <input type="date" class="form-control @error('start_date') is-invalid @enderror" name="start_date" id="start_date" value="{{ old('start_date') }}" min="{{ now()->toDateString() }}"  required>
                @error('start_date')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group col-md-3">
                <label for="inputAddress2">Hora Inicio do Evento</label>
                <input type="time" class="form-control @error('start_time') is-invalid @enderror" name="start_time" id="start_time" value="{{ old('start_time') }}" required>
                @error('start_time')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group col-md-3">
                <label for="inputAddress2">Data Fim do Evento</label>
                <input type="date" class="form-control @error('end_date') is-invalid @enderror" name="end_date" id="end_date" value="{{ old('end_date') }}"  min="{{ now()->toDateString() }}"  required>
                @error('end_date')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group col-md-3">
                <label for="inputAddress2">Hora Fim do Evento</label>
                <input type="time" class="form-control @error('end_time') is-invalid @enderror" name="end_time" id="end_time" value="{{ old('end_time') }}"  required>
                @error('end_time')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="inputState">Tipo de Evento</label>
            <select id="type" name="type"  class="form-control @error('type') is-invalid @enderror" required>
                <option disabled>Escolher o tipo de evento...</option>
                <option value="Publico">Público</option>
                <option value="Privado">Privado</option>
            </select>
            @error('type')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        @foreach($SupplierType as $type)

            @if( ( $loop->iteration % 2) !== 0)
            <div class="form-row">
            @endif

            <div class="form-group col-md-6">
                <input type="checkbox" id="suppliers[]" name="suppliers[]" value="{{  $type->id }}"> {{  $type->name }}              
            </div>

            @if( ( $loop->iteration % 2) === 0)
            </div>
            @endif

        @endforeach    

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
            <a href="/event/private"> <button type="button" class="btn btn-secondary mt-5 mb-5">Voltar</button></a>
            <button type="submit" class="btn btn-success mt-5 mb-5">Registar Evento</button>       
        </div>
    </form>
</div>