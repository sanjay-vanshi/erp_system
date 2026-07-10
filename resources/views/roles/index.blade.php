@extends('layouts.erp')

@section('content')

@include('partials.alert')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Roles</h3>

        <a href="{{ route('roles.create') }}" class="btn btn-primary">
            Add Role
        </a>
    </div>

    <div class="card shadow-sm mb-3">
        <div class="card-body">

            <form action="{{ route('roles.index') }}" method="GET">

                <div class="row">

                    <div class="col-md-5 mb-3">
                        <label class="form-label">Search</label>

                        <input
                            type="text"
                            name="search"
                            class="form-control"
                            placeholder="Search by role name..."
                            value="{{ request('search') }}">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label">Status</label>

                        <select
                            name="status"
                            class="form-select">

                            <option value="">All Status</option>

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

                    <div class="col-md-4 mb-3 d-flex align-items-end">

                        <button
                            type="submit"
                            class="btn btn-primary me-2">
                            Filter
                        </button>

                        <a
                            href="{{ route('roles.index') }}"
                            class="btn btn-secondary">
                            Reset
                        </a>

                    </div>

                </div>

            </form>

        </div>
    </div>

    <div class="card shadow-sm">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle">

                    <thead class="table-light">

                    <tr>
                        <th>#</th>
                        <th>Role Name</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th width="180">Action</th>
                    </tr>

                    </thead>

                    <tbody>

                    @forelse($roles as $role)

                        <tr>

                            <td>
                                {{ $roles->firstItem() + $loop->index }}
                            </td>

                            <td>
                                {{ $role->name }}
                            </td>

                            <td>
                                {{ $role->description ?? '-' }}
                            </td>

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

                            <td>

                                <a
                                    href="{{ route('roles.show', $role) }}"
                                    class="btn btn-sm btn-info">
                                    View
                                </a>

                                <a
                                    href="{{ route('roles.edit', $role) }}"
                                    class="btn btn-sm btn-warning">
                                    Edit
                                </a>

                                <form
                                    action="{{ route('roles.destroy', $role) }}"
                                    method="POST"
                                    class="d-inline">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this role?')">

                                        Delete

                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5" class="text-center">
                                No roles found.
                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

            {{ $roles->links() }}

        </div>

    </div>

</div>

@endsection