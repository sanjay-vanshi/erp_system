@extends('layouts.erp')

@section('content')

<div class="card shadow-sm">

    <div class="card-header bg-white">
        <h4 class="mb-0">
            Edit Leave
        </h4>
    </div>


    <div class="card-body">

        @include('leaves._form')

    </div>

</div>

@endsection