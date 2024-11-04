@extends('master/main')
@section('content')
    <div class="col-12 col-sm-10 col-md-8 col-lg-6 mx-auto">
        @component('components.suppliers.supplier-form-create');
        @endcomponent
    </div>
@endsection
