@extends('layouts.erp')

@section('content')

@include('partials.alert')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">

        <h2>
            User Management
        </h2>
         @if(Auth::user()->hasPermission('create users'))
        <a href="{{ route('users.create') }}"
           class="btn btn-primary">

            Add User

        </a>
       @endif
    </div>
        <div class="card mb-3">

        <div class="card-body">

            <form method="GET"
                  action="{{ route('users.index') }}">

                <div class="row">

                    <div class="col-md-4">

                        <input
                            type="text"
                            name="search"
                            class="form-control"
                            placeholder="Search by employee, name or email"
                            value="{{ request('search') }}">

                    </div>

                    <div class="col-md-3">

                        <select
                            name="role"
                            class="form-select">

                            <option value="">
                                All Roles
                            </option>

                            @foreach($roles as $role)

                                <option
                                    value="{{ $role->id }}"
                                    {{ request('role') == $role->id ? 'selected' : '' }}>

                                    {{ $role->name }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="col-md-3">

                        <select
                            name="status"
                            class="form-select">

                            <option value="">
                                All Status
                            </option>

                            <option value="Active"
                                {{ request('status') == 'Active' ? 'selected' : '' }}>

                                Active

                            </option>

                            <option value="Inactive"
                                {{ request('status') == 'Inactive' ? 'selected' : '' }}>

                                Inactive

                            </option>

                        </select>

                    </div>

                    <div class="col-md-2 d-flex">

                        <button
                            type="submit"
                            class="btn btn-primary me-2">

                            Search

                        </button>

                        <a href="{{ route('users.index') }}"
                           class="btn btn-secondary">

                            Reset

                        </a>

                    </div>

                </div>

            </form>

        </div>

    </div>
    <div class="card">

    <div class="card-body table-responsive">

        <table class="table table-bordered table-hover align-middle">

            <thead class="table-dark">

                <tr>

                    <th width="70">
                        #
                    </th>

                    <th>
                        Employee
                    </th>

                    <th>
                        Email
                    </th>

                    <th>
                        Role
                    </th>

                    <th>
                        Status
                    </th>

                    <th width="180">
                        Action
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($users as $user)

                    <tr>

                        <td>

                            {{ $users->firstItem() + $loop->index }}

                        </td>

                        <td>

                            @if($user->employee)

                                <strong>

                                    {{ $user->employee->employee_code }}

                                </strong>

                                <br>

                                {{ $user->employee->first_name }}
                                {{ $user->employee->last_name }}

                            @else

                                -

                            @endif

                        </td>

                        <td>

                            {{ $user->email }}

                        </td>

                        <td>

                            {{ $user->role?->name ?? '-' }}

                        </td>

                        <td>

                            @if($user->status == 'Active')

                                <span class="badge bg-success">

                                    Active

                                </span>

                            @else

                                <span class="badge bg-danger">

                                    Inactive

                                </span>

                            @endif

                        </td>

                        <td>
                                @if(Auth::user()->hasPermission('view users'))
                            <a href="{{ route('users.show', $user) }}"
                               class="btn btn-info btn-sm">

                                View

                            </a>
                              @endif

                               @if(Auth::user()->hasPermission('edit users'))
                            <a href="{{ route('users.edit', $user) }}"
                               class="btn btn-warning btn-sm">

                                Edit

                            </a>
                            @endif
                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="6"
                            class="text-center text-muted">

                            No users found.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

        {{ $users->links() }}

    </div>

</div>

</div>

@endsection