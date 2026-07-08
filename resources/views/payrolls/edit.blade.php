@extends('layouts.erp')

@section('content')

@include('partials.alert')

<div class="container">

    <h2 class="mb-4">
        Edit Payroll
    </h2>


    <form action="{{ route('payrolls.update', $payroll) }}" method="POST">

        @csrf

        @method('PUT')


        @include('payrolls._form', [
            'payroll' => $payroll
        ])


        <button type="submit" class="btn btn-primary">
            Update Payroll
        </button>


        <a href="{{ route('payrolls.index') }}" 
           class="btn btn-secondary">
            Cancel
        </a>

    </form>

</div>

@endsection