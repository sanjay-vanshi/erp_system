@extends('layouts.erp')

@section('content')

<div class="container">

    <div class="card">

        <div class="card-header">
            <h4>
                Add Holiday
            </h4>
        </div>


        <div class="card-body">


            <form action="{{ route('holidays.store') }}" method="POST">

                @csrf


                @include('holidays._form')


            </form>


        </div>

    </div>

</div>


@endsection