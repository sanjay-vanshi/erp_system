@extends('layouts.erp')

@section('content')

@include('partials.alert')

<div class="container-fluid">

    <div class="card">

        <div class="card-header">

            <h4>Edit Role</h4>

        </div>

        <div class="card-body">

            @include('roles._form')

        </div>

    </div>

</div>

@endsection