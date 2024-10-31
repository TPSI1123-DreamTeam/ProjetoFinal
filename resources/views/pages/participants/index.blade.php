@extends('master.main')

@section('content')

@component('components.participants.participants-list', ['participants' => $participants])
@endcomponent

@endsection
