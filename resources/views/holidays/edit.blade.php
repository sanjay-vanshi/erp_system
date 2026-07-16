@extends('layouts.erp')

@section('content')

<div class="container">


    <div class="card">


        <div class="card-header">

            <h4>
                Edit Holiday
            </h4>

        </div>



        <div class="card-body">


            <form action="{{ route('holidays.update',$holiday) }}" 
                  method="POST">


                @csrf

                @method('PUT')


                @include('holidays._form')


            </form>



        </div>


    </div>



</div>


@endsection