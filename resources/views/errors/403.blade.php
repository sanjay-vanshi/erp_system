@extends('layouts.erp')

@section('content')

<div class="container-fluid">

    <div class="card shadow-sm">

        <div class="card-body text-center py-5">


            <h1 class="display-1 text-danger">
                403
            </h1>


            <h3 class="mb-3">
                Access Denied
            </h3>


            <p class="text-muted">
                You do not have permission to access this page.
            </p>


            <a href="{{ route('dashboard') }}"
               class="btn btn-primary">

                Back to Dashboard

            </a>


        </div>

    </div>

</div>

@endsection