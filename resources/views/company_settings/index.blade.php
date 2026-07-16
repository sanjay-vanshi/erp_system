@extends('layouts.erp')


@section('content')


<div class="container">


@include('partials.alert')



<div class="card">


<div class="card-header">

<h4>
Company Settings
</h4>

</div>



<div class="card-body">


@include('company_settings._form')


</div>


</div>


</div>


@endsection