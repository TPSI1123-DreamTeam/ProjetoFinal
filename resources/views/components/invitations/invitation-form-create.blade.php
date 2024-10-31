@extends('master.main')
@section('content')



<form method="POST" action="{{ url('invitations/') }}">
    @csrf

    <div class="form-group">
        <label for="name">Tema</label>
        <input
        type="text"
        id="theme"
        name="theme"
        autocomplete="theme"
        placeholder="Type your theme"
        class="form-control
        @error('theme') is-invalid @enderror"
        value="{{ old('theme') }}"
        required
        aria-describedby="themeHelp"
        value="test">
        <small id="themeHelp" class="form-text text-muted">We'll never share your data with anyone else.</small>
        @error('theme')
        <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
        </span>
        @enderror
        </div>
       <br>

       <div class="form-group">
        <label for="phone">Color</label>
        <input
        type="text"
        id="color"
        name="color"
        autocomplete="color"
        placeholder="Codigo HEX cor [ Ex: #FFFFFF] "
        class="form-control
        @error('color') is-invalid @enderror"
        value="{{ old('color') }}"
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
        <label for="phone">Descrição do convite</label>
        <input
        type="text"
        id="body"
        name="body"
        autocomplete="body"
        placeholder="Do que se trata o evento"
        class="form-control
        @error('body') is-invalid @enderror"
        value="{{ old('body') }}"
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
        <label for="phone">Data</label>
        <input
        type="text"
        id="date"
        name="date"
        autocomplete="date"
        placeholder="Em que data ocorrerá?"
        class="form-control
        @error('date') is-invalid @enderror"
        value="{{ old('date') }}"
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
    <button type="submit" class="mt-2 mb-5 btn btn-primary">Submit</button>

    </form>

@endsection
