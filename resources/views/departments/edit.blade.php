@extends('layouts.erp')

@section('content')

<div class="card">

    <div class="card-header">
        <h4>Edit Department</h4>
    </div>

    <div class="card-body">

        @include('departments._form', ['department' => $department])

    </div>

</div>

@endsection