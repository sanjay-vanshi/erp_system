@extends('layouts.erp')

@section('content')

@include('partials.alert')


<div class="container">


    <div class="d-flex justify-content-between align-items-center mb-3">


        <h2>
            Holiday List
        </h2>


        @if(Auth::user()->hasPermission('create holidays'))

        <a href="{{ route('holidays.create') }}"
           class="btn btn-primary">

            Add Holiday

        </a>

        @endif


    </div>




    {{-- Search & Filter --}}

    <form method="GET"
          action="{{ route('holidays.index') }}"
          class="row g-3 mb-4">



        {{-- Search --}}

        <div class="col-md-5">


            <input
                type="text"
                name="search"
                class="form-control"
                placeholder="Search holiday..."
                value="{{ request('search') }}">


        </div>




        {{-- Year Filter --}}

        <div class="col-md-3">


            <input
                type="number"
                name="year"
                class="form-control"
                placeholder="Year"
                value="{{ request('year') }}">


        </div>




        {{-- Buttons --}}

        <div class="col-md-4">


            <button type="submit"
                    class="btn btn-primary">

                Filter

            </button>



            <a href="{{ route('holidays.index') }}"
               class="btn btn-secondary">

                Reset

            </a>


        </div>


    </form>





    {{-- Holiday Table --}}


    <div class="table-responsive">


        <table class="table table-bordered table-striped">


            <thead>


                <tr>

                    <th>#</th>

                    <th>Holiday Name</th>

                    <th>Date</th>

                    <th>Description</th>

                    <th>Status</th>

                    <th width="180">
                        Action
                    </th>

                </tr>


            </thead>




            <tbody>


            @forelse($holidays as $holiday)


                <tr>


                    <td>
                        {{ $loop->iteration }}
                    </td>




                    <td>

                        {{ $holiday->name }}

                    </td>




                    <td>

                        {{ $holiday->holiday_date
                            ? $holiday->holiday_date->format('d M Y')
                            : '-'
                        }}

                    </td>




                    <td>

                        {{ $holiday->description ?? '-' }}

                    </td>




                    <td>


                        @if($holiday->status == 'active')


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


                        @if(Auth::user()->hasPermission('view holidays'))


                        <a href="{{ route('holidays.show',$holiday) }}"
                           class="btn btn-info btn-sm">

                            View

                        </a>


                        @endif





                        @if(Auth::user()->hasPermission('edit holidays'))


                        <a href="{{ route('holidays.edit',$holiday) }}"
                           class="btn btn-warning btn-sm">

                            Edit

                        </a>


                        @endif





                        @if(Auth::user()->hasPermission('delete holidays'))


                        <form action="{{ route('holidays.destroy',$holiday) }}"
                              method="POST"
                              class="d-inline">


                            @csrf

                            @method('DELETE')


                            <button type="submit"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure?')">

                                Delete

                            </button>


                        </form>


                        @endif



                    </td>



                </tr>



            @empty



                <tr>


                    <td colspan="6"
                        class="text-center">

                        No holidays found.

                    </td>


                </tr>



            @endforelse



            </tbody>



        </table>



    </div>





    {{-- Pagination --}}

    {{ $holidays->links() }}



</div>


@endsection