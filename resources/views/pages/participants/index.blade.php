@extends('master.main')

@section('content')

@component('components.participants.participants-list', ['participants' => $participants])
@endcomponent

@endsection

@section('script')
$(window).on('load',function(){
    var delayMs = 1500; // delay in milliseconds

    setTimeout(function(){
        $('#listModal').modal('show');
    }, delayMs);
    });
 @endsection
