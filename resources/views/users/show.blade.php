@extends('layouts.erp')

@section('content')

@include('partials.alert')

<div class="container">

    <div class="card">

        <div class="card-header d-flex justify-content-between align-items-center">

            <h4>

                User Details

            </h4>

            <a href="{{ route('users.index') }}"
               class="btn btn-secondary">

                Back

            </a>

        </div>

        <div class="card-body">

            <div class="row">

                {{-- Employee --}}
                <div class="col-md-6 mb-3">

                    <strong>Employee</strong>

                    <p class="mb-0">

                        {{ $user->employee?->employee_code }}

                        -

                        {{ $user->employee?->first_name }}

                        {{ $user->employee?->last_name }}

                    </p>

                </div>

                {{-- Email --}}
                <div class="col-md-6 mb-3">

                    <strong>Email</strong>

                    <p class="mb-0">

                        {{ $user->email }}

                    </p>

                </div>

                {{-- Department --}}
                <div class="col-md-6 mb-3">

                    <strong>Department</strong>

                    <p class="mb-0">

                        {{ $user->employee?->department?->name ?? '-' }}

                    </p>

                </div>

                {{-- Designation --}}
                <div class="col-md-6 mb-3">

                    <strong>Designation</strong>

                    <p class="mb-0">

                        {{ $user->employee?->designation?->title ?? '-' }}

                    </p>

                </div>

                {{-- Role --}}
                <div class="col-md-6 mb-3">

                    <strong>Role</strong>

                    <p class="mb-0">

                        {{ $user->role?->name ?? '-' }}

                    </p>

                </div>

                {{-- Status --}}
                <div class="col-md-6 mb-3">

                    <strong>Status</strong>

                    <p>

                        @if($user->status == 'Active')

                            <span class="badge bg-success">

                                Active

                            </span>

                        @else

                            <span class="badge bg-danger">

                                Inactive

                            </span>

                        @endif

                    </p>

                </div>

                {{-- Created At --}}
                <div class="col-md-6 mb-3">

                    <strong>Created At</strong>

                    <p class="mb-0">

                        {{ $user->created_at->format('d M Y h:i A') }}

                    </p>

                </div>

                {{-- Updated At --}}
                <div class="col-md-6 mb-3">

                    <strong>Updated At</strong>

                    <p class="mb-0">

                        {{ $user->updated_at->format('d M Y h:i A') }}

                    </p>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection