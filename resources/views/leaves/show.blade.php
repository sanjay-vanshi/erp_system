@extends('layouts.erp')

@section('content')

<div class="container-fluid">

    {{-- Header --}}
    <div class="card shadow-sm mb-3">

        <div class="card-header bg-white d-flex justify-content-between align-items-center">

            <h4 class="mb-0">
                Leave Details
            </h4>


            <a href="{{ route('leaves.index') }}"
               class="btn btn-secondary btn-sm">

                Back

            </a>

        </div>

    </div>



    {{-- Employee Information --}}
    <div class="card shadow-sm mb-3">

        <div class="card-header bg-white">

            <h5 class="mb-0">
                Employee Information
            </h5>

        </div>


        <div class="card-body">


            <div class="row">


                <div class="col-md-4">

                    <strong>
                        Employee Code:
                    </strong>

                    {{ $leave->employee->employee_code }}

                </div>



                <div class="col-md-4">

                    <strong>
                        Name:
                    </strong>

                    {{ $leave->employee->first_name }}
                    {{ $leave->employee->last_name }}

                </div>



                <div class="col-md-4">

                    <strong>
                        Department:
                    </strong>

                    {{ $leave->employee->department->name ?? '-' }}

                </div>



                <div class="col-md-4 mt-3">

                    <strong>
                        Designation:
                    </strong>

                    {{ $leave->employee->designation->title ?? '-' }}

                </div>


            </div>


        </div>

    </div>





    {{-- Leave Information --}}
    <div class="card shadow-sm mb-3">

        <div class="card-header bg-white">

            <h5 class="mb-0">
                Leave Information
            </h5>

        </div>



        <div class="card-body">


            <div class="row">


                <div class="col-md-4">

                    <strong>
                        Leave Type:
                    </strong>

                    {{ ucfirst($leave->leave_type) }}

                </div>



                <div class="col-md-4">

                    <strong>
                        From Date:
                    </strong>

                    {{ $leave->from_date }}

                </div>



                <div class="col-md-4">

                    <strong>
                        To Date:
                    </strong>

                    {{ $leave->to_date }}

                </div>



                <div class="col-md-4 mt-3">

                    <strong>
                        Total Days:
                    </strong>

                    {{ $leave->total_days }}

                </div>



                <div class="col-md-8 mt-3">

                    <strong>
                        Reason:
                    </strong>

                    {{ $leave->reason }}

                </div>


            </div>


        </div>


    </div>





    {{-- Status Information --}}
    <div class="card shadow-sm mb-3">


        <div class="card-header bg-white">

            <h5 class="mb-0">
                Status Information
            </h5>

        </div>


        <div class="card-body">


            <strong>
                Status:
            </strong>


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


            <br><br>


          <strong>
    Action By:
</strong>

{{ $leave->approver->name ?? '-' }}


<br><br>


<strong>
    Remarks:
</strong>

{{ $leave->remarks ?? '-' }}


        </div>


    </div>


</div>


@endsection