@extends('layouts.erp')

@section('content')

<div class="container-fluid">

    {{-- Header --}}
    <div class="card shadow-sm mb-3">

        <div class="card-header bg-white d-flex justify-content-between align-items-center">

            <h4 class="mb-0">

                Permission Details

            </h4>


            <a href="{{ route('permissions.index') }}"
               class="btn btn-secondary btn-sm">

                Back

            </a>

        </div>

    </div>



    {{-- Permission Information --}}
    <div class="card shadow-sm mb-3">

        <div class="card-header bg-white">

            <h5 class="mb-0">

                Permission Information

            </h5>

        </div>


        <div class="card-body">

            <div class="row">

                <div class="col-md-6">

                    <strong>

                        Permission Name:

                    </strong>

                    {{ $permission->name }}

                </div>



                <div class="col-md-6">

                    <strong>

                        Guard Name:

                    </strong>

                    {{ $permission->guard_name }}

                </div>

            </div>

        </div>

    </div>




    {{-- System Information --}}
    <div class="card shadow-sm mb-3">

        <div class="card-header bg-white">

            <h5 class="mb-0">

                System Information

            </h5>

        </div>


        <div class="card-body">

            <div class="row">

                <div class="col-md-6">

                    <strong>

                        Created At:

                    </strong>

                    {{ $permission->created_at->format('d M Y, h:i A') }}

                </div>



                <div class="col-md-6">

                    <strong>

                        Updated At:

                    </strong>

                    {{ $permission->updated_at->format('d M Y, h:i A') }}

                </div>

            </div>

        </div>

    </div>

</div>

@endsection