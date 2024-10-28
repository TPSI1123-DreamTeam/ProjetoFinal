@extends('master.main')
@section('content')

@component('components.participants.participant-form-show', ['participant' => $participant])
@endcomponent

<form method="POST" action="{{ url('participants/') }}">
    @csrf


    <div class="form-group">
    <label for="name">Nome</label>
    <input
    type="text"
    disabled
    id="name"
    name="name"
    autocomplete="name"
    placeholder="Type your name"
    class="form-control
    @error('name') is-invalid @enderror"
    value="{{$participant->name}}">
    required
    aria-describedby="nameHelp"
    value="test">
    <small id="nameHelp" class="form-text text-muted">We'll never share your data with anyone else.</small>
    @error('name')
    <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
    </span>
    @enderror
    </div>
   <br>

   <div class="form-group">
    <label for="phone">Nº Telefone</label>
    <input
    type="text"
    disabled
    id="phone"
    name="phone"
    autocomplete="phone"
    placeholder="Digite o contacto telefónico"
    class="form-control
    @error('phone') is-invalid @enderror"
    value="{{$participant->phone}}">
    required
    aria-describedby="phoneHelp"
    value="test">
    <small id="phoneHelp" class="form-text text-muted">We'll never share your data with anyone else.</small>
    @error('phone')
    <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
    </span>
    @enderror
    </div>
   <br>

   <div class="form-group">
    <label for="phone">Email</label>
    <input
    type="text"
    disabled
    id="email"
    name="email"
    autocomplete="email"
    placeholder="Digite o email do participante"
    class="form-control
    @error('email') is-invalid @enderror"
    value="{{$participant->email}}"
    required
    aria-describedby="emailHelp"
    value="test">
    <small id="emailHelp" class="form-text text-muted">We'll never share your data with anyone else.</small>
    @error('email')
    <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
    </span>
    @enderror
    </div>
   <br>


    <br>
    <div>

        <label for="confirmation">Presença Confirmada?</label><br>
        <input disabled type="radio" id="yes" name="confirmation" value = "1" @if ($participant->confirmation) checked @endif>
        <label for="yes">Sim</label>
        <input disabled type="radio" id="no" name="confirmation" value = "0" @if (!$participant->confirmation) checked @endif>
        <label for="no">Não</label>
    </div>

    </form>



@endsection
