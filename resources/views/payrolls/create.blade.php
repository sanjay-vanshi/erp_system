@extends('layouts.erp')

@section('content')

@include('partials.alert')

<div class="container">

    <h2 class="mb-4">
        Create Payroll
    </h2>


    <form action="{{ route('payrolls.store') }}" method="POST">

        @csrf

        @include('payrolls._form', [
            'payroll' => null
        ])


        <button type="submit" class="btn btn-primary">
            Save Payroll
        </button>


        <a href="{{ route('payrolls.index') }}" 
           class="btn btn-secondary">
            Cancel
        </a>

    </form>

</div>

@endsection