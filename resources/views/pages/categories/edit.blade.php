@extends('master.main')
@section('content')

@component('components.categories.category-form-edit', ['category' => $category])
@endcomponent

<form method="POST" action="{{ url('categories/'  . $category->id) }}">
    @csrf
    @method('PUT')

       <div class="form-group">
        <label for="name">Descrição</label>
        <input
        type="text"        
        id="description"
        name="description"
        autocomplete="description"
        placeholder="Type your description"
        class="form-control
        @error('description') is-invalid @enderror"
        value="{{$category->description}}"
        required
        aria-describedby="descriptionHelp"
        value="test">
        <small id="descriptionHelp" class="form-text text-muted">We'll never share your data with anyone else.</small>
        @error('description')
        <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
        </span>
        @enderror
        </div>
       <br>
            
    <button type="submit">Salvar Alterações</button>
    </form>



@endsection
