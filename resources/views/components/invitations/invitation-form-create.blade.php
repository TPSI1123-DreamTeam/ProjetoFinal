<div class="event-wrapper">
    <div class="title-hidder-div">
        <h1>Criação do convite</h1>
    </div>
</div>
<div class="linha-divisoria-event-manager"></div>

<form method="POST" action="{{ url('invitations/') }}" enctype="multipart/form-data" class="inv-create-form">
    @csrf
    <div class="">
        <label for="name">Título:</label>
            <input
            type="text"
            id="title"
            name="title"
            autocomplete="title"
            placeholder="Escolha o titulo!"
            class="
            @error('title') is-invalid @enderror"
            value="{{ old('title') }}"
            required
            value="test">
        <br>
        @error('title')
        <span class="" role="alert">
        <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="">
        <label for="body">Descrição:</label>
        <input
            type="text"
            id="body"
            name="body"
            autocomplete="body"
            placeholder="Descreva o evento!"
            class="
            @error('body') is-invalid @enderror"
            value="{{ old('body') }}"
            required
            aria-describedby="bodyHelp"
            value="test">
        @error('body')
        <span class="" role="alert">
        <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="">
        <label for="date">Data:</label>
        <input
            type="date"
            id="date"
            name="date"
            autocomplete="date"
            placeholder="Em que data ocorrerá?"
            class="
            @error('date') is-invalid @enderror"
            value="{{ old('date') }}"
            required
            aria-describedby="dateHelp"
            value="test">
        @error('date')
        <span class="" role="alert">
        <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="">
        <label for="place">Localização:</label>
        <input
            type="text"
            id="place"
            name="place"
            autocomplete="place"
            placeholder="Onde ocorrerá o evento?"
            class="
            @error('place') is-invalid @enderror"
            value="{{ old('place') }}"
            required
            aria-describedby="placeHelp"
            value="test">
        @error('place')
        <span class="" role="alert">
        <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="">
        <label for="image">Imagem do Convite:</label>
        <input
            type="file"
            id="image"
            name="image"
            autocomplete="image"
            placeholder="Codigo HEX cor [ Ex: #FFFFFF] "
            class="
            @error('image') is-invalid @enderror"
            value="{{ old('image') }}"
            required
            aria-describedby="imageHelp"
            value="test">
        @error('image')
        <span class="" role="alert">
        <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <br>
    <input hidden name="trueId" value="{{$trueId}}">
    {{-- input /\ serve para verificar se o id do evento passou para a página --}}
    <div class="submit-btn-create-inv">
        <button type="submit" class="submit-btn-inv">Submeter</button>
    </div>
</form>
<div class="submit-btn-create-inv">
    <a href="/invitations">
        <button type="button" class="go-back-invList-btn">Voltar</button>
    </a>
</div>