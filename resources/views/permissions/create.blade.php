@extends('layouts.erp')

@section('content')

<div class="container">

    <div class="card">

        <div class="card-header">

            <h4>

                Create Permission

            </h4>

        </div>


        <div class="card-body">

            @include('permissions._form')

        </div>

    </div>

</div>

@endsection