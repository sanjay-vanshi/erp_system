@extends('layouts.erp')

@section('content')

@include('partials.alert')

{{-- Search Form --}}
<form method="GET" action="{{ route('designations.index') }}" class="mb-3">

    <div class="row">

        <div class="col-md-4">

            <input
                type="text"
                name="search"
                class="form-control"
                placeholder="Search by title..."
                value="{{ request('search') }}">

        </div>

       

            <div class="d-flex gap-2 col-md-4">
    <button class="btn btn-primary">
        Search
    </button>

    <a href="{{ route('departments.index') }}"
       class="btn btn-secondary">
        Reset
    </a>
</div>

    </div>

</form>

<div class="card shadow-sm">

    <div class="card-header bg-white d-flex justify-content-between align-items-center">

        <h4 class="mb-0">Designation List</h4>
       @if(Auth::user()->hasPermission('create designations'))
        <a href="{{ route('designations.create') }}"
           class="btn btn-primary btn-sm">
            Add Designation
        </a>
       @endif
    </div>

    <div class="card-body">

        <table class="table table-bordered table-hover align-middle">

            <thead>

                <tr>

                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Action</th>

                </tr>

            </thead>

            <tbody>

                @forelse($designations as $designation)

                    <tr>

                        <td>{{ $designation->id }}</td>

                        <td>{{ $designation->title }}</td>

                        <td>{{ $designation->description }}</td>

                        <td>

                            @if($designation->status)

                                <span class="badge bg-success">
                                    Active
                                </span>

                            @else

                                <span class="badge bg-danger">
                                    Inactive
                                </span>

                            @endif

                        </td>

                        <td class="text-center">

                            
                               @if(Auth::user()->hasPermission('edit designations'))
                                <a href="{{ route('designations.edit', $designation->id) }}"
                                   class="btn btn-warning btn-sm">
                                    Edit
                                </a>
                                 @endif

                                 @if(Auth::user()->hasPermission('delete designations'))
                                <form action="{{ route('designations.destroy', $designation->id) }}"
                                      method="POST" class="d-inline">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete this designation?')">

                                        Delete

                                    </button>

                                </form>

                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="5" class="text-center">

                            No Designations Found

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

        <div class="mt-3">

            {{ $designations->links() }}

        </div>

    </div>

</div>

@endsection