@extends('master.main')

@section('content')

@component('components.categories.categories-list', ['categories' => $categories])
@endcomponent

@endsection
