@extends('master.main')

@section('content')

@component('components.invitations.invitations-list', ['participants' => $participants, 'invitation' => $invitation, 'events' => $events, 'trueId' => $trueId])
@endcomponent

@endsection
