@extends('layouts.erp')

@section('content')

@include('partials.alert')

<div class="container-fluid">

    <div class="card">

        <div class="card-header d-flex justify-content-between align-items-center">

            <h4>Role Details</h4>

            <a href="{{ route('roles.index') }}"
               class="btn btn-secondary">

                Back

            </a>

        </div>


        <div class="card-body">

            <table class="table table-bordered">

                <tr>

                    <th width="200">
                        ID
                    </th>

                    <td>
                        {{ $role->id }}
                    </td>

                </tr>


                <tr>

                    <th>
                        Role Name
                    </th>

                    <td>
                        {{ $role->name }}
                    </td>

                </tr>


                <tr>

                    <th>
                        Description
                    </th>

                    <td>
                        {{ $role->description ?: '-' }}
                    </td>

                </tr>


                <tr>

                    <th>
                        Status
                    </th>

                    <td>

                        @if($role->status == 'Active')

                            <span class="badge bg-success">

                                Active

                            </span>

                        @else

                            <span class="badge bg-danger">

                                Inactive

                            </span>

                        @endif

                    </td>

                </tr>


                <tr>

                    <th>
                        Created At
                    </th>

                    <td>
                        {{ $role->created_at->format('d M Y h:i A') }}
                    </td>

                </tr>


                <tr>

                    <th>
                        Updated At
                    </th>

                    <td>
                        {{ $role->updated_at->format('d M Y h:i A') }}
                    </td>

                </tr>

            </table>

        </div>

    </div>

</div>

@endsection