@extends('master.main')

@section('content')

@component('components.invitations.invitations-list', ['invitations' => $invitations])
@endcomponent

@endsection
