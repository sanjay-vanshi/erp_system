@extends('layouts.erp')

@section('content')

@include('partials.alert')

<div class="card shadow-sm">

    <div class="card-header bg-white">
        <h4 class="mb-0">Edit Designation</h4>
    </div>

    <div class="card-body">

        @include('designations._form', [
            'designation' => $designation
        ])

    </div>

</div>

@endsection