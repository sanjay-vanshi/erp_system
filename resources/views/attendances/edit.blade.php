@extends('layouts.erp')

@section('content')

<div class="card shadow-sm">

    <div class="card-header bg-white">
        <h4 class="mb-0">Edit Attendance</h4>
    </div>

    <div class="card-body">

        @include('attendances._form')

    </div>

</div>

@endsection