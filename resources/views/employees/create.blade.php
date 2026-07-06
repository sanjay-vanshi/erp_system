@extends('layouts.erp')

@section('content')

@include('partials.alert')

<div class="card shadow-sm">

    <div class="card-header bg-white">
        <h4 class="mb-0">Add Employee</h4>
    </div>

    <div class="card-body">

        @include('employees._form', [
            'employee' => null
        ])

    </div>

</div>

@endsection