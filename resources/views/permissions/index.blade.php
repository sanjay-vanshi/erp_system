@extends('layouts.erp')

@section('content')

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-3">

        <h2>

            Permission Management

        </h2>

        <a href="{{ route('permissions.create') }}"
           class="btn btn-primary">

            Add Permission

        </a>

    </div>


    @include('partials.alert')


    {{-- Search --}}
    <form action="{{ route('permissions.index') }}"
          method="GET"
          class="row g-3 mb-3">

        <div class="col-md-4">

            <input
                type="text"
                name="search"
                class="form-control"
                placeholder="Search permission..."
                value="{{ request('search') }}">

        </div>


        <div class="col-md-auto">

            <button class="btn btn-primary">

                Search

            </button>

        </div>


        <div class="col-md-auto">

            <a href="{{ route('permissions.index') }}"
               class="btn btn-secondary">

                Reset

            </a>

        </div>

    </form>



    <div class="table-responsive">

        <table class="table table-bordered table-striped">

            <thead class="table-dark">

                <tr>

                    <th width="70">

                        #

                    </th>

                    <th>

                        Permission Name

                    </th>

                    <th>

                        Guard

                    </th>

                    <th class="text-center" width="220">

                        Action

                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($permissions as $permission)

                    <tr>

                        <td>

                            {{ $permissions->firstItem() + $loop->index }}

                        </td>

                        <td>

                            {{ $permission->name }}

                        </td>

                        <td>

                            {{ $permission->guard_name }}

                        </td>

                        <td class="text-center">

                            <div class="d-flex justify-content-center gap-2">

                                <a href="{{ route('permissions.show', $permission->id) }}"
                                   class="btn btn-info btn-sm">

                                    Show

                                </a>

                                <a href="{{ route('permissions.edit', $permission->id) }}"
                                   class="btn btn-warning btn-sm">

                                    Edit

                                </a>

                                <form action="{{ route('permissions.destroy', $permission->id) }}"
                                      method="POST">

                                    @csrf

                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this permission?')">

                                        Delete

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="4"
                            class="text-center">

                            No permissions found.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>


    {{ $permissions->links() }}

</div>

@endsection