@extends('layouts.erp')

@section('content')

@include('partials.alert')

<div class="container">

    <div class="card">

        <div class="card-header">

            <h4>

                Create User

            </h4>

        </div>

        <div class="card-body">

            @include('users._form')

        </div>

    </div>

</div>

@endsection