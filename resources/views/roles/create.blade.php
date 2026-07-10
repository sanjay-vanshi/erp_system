@extends('layouts.erp')

@section('content')

@include('partials.alert')

<div class="container-fluid">

    <div class="card shadow-sm">

        <div class="card-header">
            <h3>Create Role</h3>
        </div>

        <div class="card-body">

            @include('roles._form', [
                'route' => route('roles.store'),
                'method' => 'POST',
                'role' => null,
            ])

        </div>

    </div>

</div>

@endsection