@extends('layouts.erp')

@section('content')

<div class="container">

    <h4 class="mb-3">
        Edit Employee Document
    </h4>


    @include('partials.alert')


    @include('employee_documents._form')


</div>

@endsection