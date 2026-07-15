    @extends('layouts.erp')

@section('content')

<div class="container-fluid">


    <div class="card">


        <div class="card-header d-flex justify-content-between align-items-center">

            <h5 class="mb-0">
                Activity Log Details
            </h5>


            <a href="{{ route('activity-logs.index') }}"
               class="btn btn-secondary btn-sm">

                Back

            </a>

        </div>



        <div class="card-body">


            <div class="row">


                {{-- User --}}

                <div class="col-md-6 mb-3">

                    <strong>User:</strong>

                    <p>
                        {{ $activityLog->user?->name ?? 'System' }}
                    </p>

                </div>



                {{-- Module --}}

                <div class="col-md-6 mb-3">

                    <strong>Module:</strong>

                    <p>
                        {{ $activityLog->module }}
                    </p>

                </div>




                {{-- Action --}}

                <div class="col-md-6 mb-3">

                    <strong>Action:</strong>

                    <p>
                        {{ ucfirst($activityLog->action) }}
                    </p>

                </div>




                {{-- Record ID --}}

                <div class="col-md-6 mb-3">

                    <strong>Record ID:</strong>

                    <p>
                        {{ $activityLog->record_id ?? '-' }}
                    </p>

                </div>




                {{-- Description --}}

                <div class="col-md-12 mb-3">

                    <strong>Description:</strong>

                    <p>
                        {{ $activityLog->description }}
                    </p>

                </div>




                {{-- Created At --}}

                <div class="col-md-6 mb-3">

                    <strong>Date:</strong>

                    <p>
                        {{ $activityLog->created_at->format('d M Y h:i A') }}
                    </p>

                </div>




                {{-- Updated At --}}

                <div class="col-md-6 mb-3">

                    <strong>Updated At:</strong>

                    <p>
                        {{ $activityLog->updated_at->format('d M Y h:i A') }}
                    </p>

                </div>


            </div>


        </div>

    </div>


</div>

@endsection