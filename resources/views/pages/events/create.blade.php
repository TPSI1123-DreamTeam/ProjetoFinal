@extends('master.main')
@section('content')
    @component('components.events.event-create', ['category' => $category, 'suppliers' => $suppliers, 'categories'=> $categories, 'SupplierType' => $SupplierType])
    @endcomponent
@endsection