@extends('layouts.erp')

@section('content')

<div class="card">

    <div class="card-header">
        <h4>Add Department</h4>
    </div>

    <div class="card-body">

        @include('departments._form')

    </div>

</div>

@endsection