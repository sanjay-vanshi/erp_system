@extends('layouts.erp')

@section('content')

@include('partials.alert')


{{-- SEARCH --}}
<form method="GET" action="{{ route('leaves.index') }}" class="mb-3">

    <div class="row g-2">

        <div class="col-md-4">

            <input 
                type="text"
                name="search"
                class="form-control"
                placeholder="Search employee, leave type, status..."
                value="{{ request('search') }}">
                <div class="col-md-3">

    <select name="status"
            class="form-select">


        <option value="">
            All Status
        </option>


        <option value="pending"
        {{ request('status') == 'pending' ? 'selected' : '' }}>

            Pending

        </option>


        <option value="approved"
        {{ request('status') == 'approved' ? 'selected' : '' }}>

            Approved

        </option>


        <option value="rejected"
        {{ request('status') == 'rejected' ? 'selected' : '' }}>

            Rejected

        </option>


    </select>

</div>

        </div>


        <div class="col-md-2">

            <button class="btn btn-primary w-100">
                Search
            </button>

        </div>
          

        <div class="col-md-2">

            <a href="{{ route('leaves.index') }}"
               class="btn btn-secondary w-100">

                Reset

            </a>

        </div>


    </div>

</form>




{{-- CARD --}}

<div class="card shadow-sm">


    <div class="card-header bg-white d-flex justify-content-between align-items-center">


        <h4 class="mb-0">
            Leave List
        </h4>


        <a href="{{ route('leaves.create') }}"
           class="btn btn-primary btn-sm">

            Apply Leave

        </a>


    </div>




    <div class="card-body">


        <table class="table table-bordered table-hover align-middle">


            <thead>

                <tr>

                    <th>ID</th>

                    <th>Employee</th>

                    <th>Leave Type</th>

                    <th>From Date</th>

                    <th>To Date</th>

                    <th>Total Days</th>

                    <th>Status</th>

                    <th>Action</th>

                </tr>

            </thead>



            <tbody>


            @forelse($leaves as $leave)


                <tr>


                    <td>
                        {{ $leave->id }}
                    </td>



                    <td>

                        {{ $leave->employee->employee_code }}

                        <br>

                        {{ $leave->employee->first_name }}
                        {{ $leave->employee->last_name }}

                    </td>




                    <td>

                        {{ ucfirst($leave->leave_type) }}

                    </td>




                    <td>

                        {{ $leave->from_date }}

                    </td>




                    <td>

                        {{ $leave->to_date }}

                    </td>




                    <td>

                        {{ $leave->total_days }}

                    </td>




                    <td>


                        @if($leave->status == 'approved')

                            <span class="badge bg-success">
                                Approved
                            </span>


                        @elseif($leave->status == 'rejected')


                            <span class="badge bg-danger">
                                Rejected
                            </span>


                        @else


                            <span class="badge bg-warning text-dark">
                                Pending
                            </span>


                        @endif


                    </td>




                   <td>


    {{-- View --}}
    <a href="{{ route('leaves.show',$leave->id) }}"
       class="btn btn-info btn-sm">

        View

    </a>



    {{-- Approval Buttons --}}
    @if($leave->status == 'pending')


        {{-- Approve --}}
        <form action="{{ route('leaves.approve',$leave->id) }}"
              method="POST"
              class="d-inline">

            @csrf
            @method('PATCH')


            <button type="submit"
                    class="btn btn-success btn-sm"
                    onclick="return confirm('Approve this leave?')">

                Approve

            </button>

        </form>




        {{-- Reject --}}
        <a href="{{ route('leaves.reject.form',$leave->id) }}"class="btn btn-danger btn-sm">Reject</a>


    @endif




    {{-- Edit --}}
    <a href="{{ route('leaves.edit',$leave->id) }}"
       class="btn btn-warning btn-sm">

        Edit

    </a>





    {{-- Delete --}}
    <form action="{{ route('leaves.destroy',$leave->id) }}"
          method="POST"
          class="d-inline">


        @csrf
        @method('DELETE')


        <button type="submit"
                class="btn btn-secondary btn-sm"
                onclick="return confirm('Delete this leave?')">

            Delete

        </button>


    </form>


</td>


                </tr>


            @empty


                <tr>

                    <td colspan="8"
                        class="text-center">

                        No Leave Records Found

                    </td>

                </tr>


            @endforelse



            </tbody>


        </table>



        <div class="mt-3">

            {{ $leaves->links() }}

        </div>


    </div>


</div>


@endsection