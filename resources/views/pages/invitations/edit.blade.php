@extends('master.main')
@section('content')

@component('components.invitations.invitation-form-edit', ['invitation' => $invitation])
@endcomponent

<form method="POST" action="{{ url('invitations/'  . $invitation->id) }}">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="name">Título</label>
        <input
        type="text"
        id="title"
        name="title"
        autocomplete="title"
        placeholder="Type your title"
        class="form-control
        @error('title') is-invalid @enderror"
        value="{{$invitation->title}}"
        required
        aria-describedby="titleHelp"
        value="test">
        <small id="titleHelp" class="form-text text-muted">We'll never share your data with anyone else.</small>
        @error('title')
        <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
        </span>
        @enderror
        </div>
       <br>

       <div class="form-group">
        <label for="name">Texto do Convite</label>
        <input
        type="text"
        id="body"
        name="body"
        autocomplete="body"
        placeholder="Type your body"
        class="form-control
        @error('body') is-invalid @enderror"
        value="{{$invitation->body}}"
        required
        aria-describedby="bodyHelp"
        value="test">
        <small id="bodyHelp" class="form-text text-muted">We'll never share your data with anyone else.</small>
        @error('body')
        <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
        </span>
        @enderror
        </div>
       <br>

       <div class="form-group">
        <label for="phone">Imagem do Convite</label>
        <label>Escolher Imagem:</label>
        <input
        type="file"
        id="image"
        name="image"
        autocomplete="image"
        placeholder="Codigo HEX cor [ Ex: #FFFFFF] "
        class="form-control
        @error('image') is-invalid @enderror"
        value="{{$invitation->image}}"
        required
        aria-describedby="imageHelp"
        value="test">
        <small id="imageHelp" class="form-text text-muted">We'll never share your data with anyone else.</small>
        @error('image')
        <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
        </span>
        @enderror
        </div>
       <br>

       <div class="form-group">
        <label for="phone">Data</label>
        <input
        type="text"
        id="date"
        name="date"
        autocomplete="date"
        placeholder="Em que data ocorrerá?"
        class="form-control
        @error('date') is-invalid @enderror"
        value="{{$invitation->date}}"
        required
        aria-describedby="dateHelp"
        value="test">
        <small id="dateHelp" class="form-text text-muted">We'll never share your data with anyone else.</small>
        @error('date')
        <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
        </span>
        @enderror
        </div>
        <br>

        <div class="form-group">
            <label for="phone">Local do Evento</label>
            <input
            type="text"
            id="place"
            name="place"
            autocomplete="place"
            placeholder="Onde ocorrerá o evento?"
            class="form-control
            @error('place') is-invalid @enderror"
            value="{{$invitation->place}}"
            required
            aria-describedby="placeHelp"
            value="test">
            <small id="placeHelp" class="form-text text-muted">We'll never share your data with anyone else.</small>
            @error('place')
            <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
            </span>
            @enderror
            </div>
            <br>
            
    <button type="submit">Salvar Alterações</button>
    </form>



@endsection
