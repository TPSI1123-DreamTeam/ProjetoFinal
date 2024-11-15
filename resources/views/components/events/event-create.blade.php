<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<div class="container">
    <div class="d-flex align-items-center">
        <p class="text-sm/6 font-semibold text-gray-900">Create Event - Formulário para {{ $category->description }}</p>
    </div>
    <br>
    <!-- RECEBE A CATEGORIA SELECIONADA NO ECRA ANTERIOR -->
    <form  method="POST" action="{{ url('/events') }}">
        @csrf

        <div class="form-row">
            <div class="form-group col-md-6">
            <label for="inputEmail4">Nome do Evento</label> 
            <input type="text" class="form-control" name="name" id="name" placeholder="Nome do Evento">
            <input type="hidden" name="owner_id"    id="owner_id" value="{{ Auth::User()->id }}" >
            <input type="hidden" name="category_id" id="category_id" value="{{ $category->id }}" >
            <input type="hidden" name="amount"  id="amount" value="0" >
            </div>
            <div class="form-group col-md-6">
            <label for="inputlocalization">Localização</label>
            <input type="text" class="form-control" name="localization"  id="localization" placeholder="Localização do evento">
            </div>
        </div>
        <div class="form-group">
            <label for="inputAddress">Descrição do Evento</label>
            <input type="text-area" class="form-control" name="description"  id="description" placeholder="Breve descrição para ser apresentada no portal">
        </div>
        
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="inputAddress2">Data Inicio do Evento</label>
                <input type="date" class="form-control" name="start_date" id="start_date" placeholder="">
            </div>
            <div class="form-group col-md-2">
                <label for="inputAddress2">Hora Inicio do Evento</label>
                <input type="time" class="form-control" name="start_time" id="start_time" placeholder="" disabled>
            </div>

            <div class="form-group col-md-4">
                <label for="inputAddress2">Data Fim do Evento</label>
                <input type="date" class="form-control" name="end_date" id="end_date" placeholder="" >
            </div>
            <div class="form-group col-md-2">
                <label for="inputAddress2">Hora Fim do Evento</label>
                <input type="time" class="form-control" name="end_time" id="end_time" placeholder="" disabled>
            </div>
        </div>

        <div class="form-group">
            <label for="inputState">Tipo de Evento</label>
            <select id="type" name="type"  class="form-control">
                <option disabled>Escolher...</option>
                <option value="Publico">Público</option>
                <option value="Privado">Privado</option>
            </select>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <input type="checkbox" name="suppliers1" aria-label="Checkbox for following text input" disabled> Locação de espaços
            </div>
            <div class="form-group col-md-6">
                <input type="checkbox" name="suppliers2" aria-label="Checkbox for following text input" disabled> Catering
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <input type="checkbox" name="suppliers3" aria-label="Checkbox for following text input" disabled> Decoração
            </div>
            <div class="form-group col-md-6">
                <input type="checkbox" name="suppliers4" aria-label="Checkbox for following text input" disabled> Entretenimento
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <input type="checkbox" name="suppliers5" aria-label="Checkbox for following text input" disabled> Serviços técnicos
            </div>
            <div class="form-group col-md-6">
                <input type="checkbox" name="suppliers6" aria-label="Checkbox for following text input" disabled> Produção e logística'
            </div>
        </div>  

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
            </div>
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="image" name="image" aria-describedby="inputGroupFileAddon01" disabled>
                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
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


