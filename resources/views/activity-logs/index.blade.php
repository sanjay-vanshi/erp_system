@extends('layouts.erp')

@section('content')

<div class="container-fluid">

    <div class="card">

        <div class="card-header d-flex justify-content-between align-items-center">

            <h5 class="mb-0">
                Activity Logs
            </h5>

        </div>


        <div class="card-body">


            {{-- Alert --}}
            @include('partials.alert')


            {{-- Search & Filter --}}
            <form method="GET" action="{{ route('activity-logs.index') }}">

                <div class="row mb-3">


                    {{-- Search --}}
                    <div class="col-md-3">

                        <input type="text"
                               name="search"
                               class="form-control"
                               placeholder="Search..."
                               value="{{ request('search') }}">

                    </div>


                    {{-- User --}}
                    <div class="col-md-2">

                        <select name="user_id"
                                class="form-select">

                            <option value="">
                                All Users
                            </option>


                            @foreach($users as $user)

                                <option value="{{ $user->id }}"
                                    {{ request('user_id') == $user->id ? 'selected' : '' }}>

                                    {{ $user->name }}

                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- Module --}}
                    <div class="col-md-2">

                        <select name="module"
                                class="form-select">

                            <option value="">
                                All Modules
                            </option>


                            @foreach($modules as $module)

                                <option value="{{ $module }}"
                                    {{ request('module') == $module ? 'selected' : '' }}>

                                    {{ $module }}

                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- Action --}}
                    <div class="col-md-2">

                        <select name="action"
                                class="form-select">

                            <option value="">
                                All Actions
                            </option>


                            @foreach($actions as $action)

                                <option value="{{ $action }}"
                                    {{ request('action') == $action ? 'selected' : '' }}>

                                    {{ ucfirst($action) }}

                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- Date --}}
                    <div class="col-md-2">

                        <input type="date"
                               name="date"
                               class="form-control"
                               value="{{ request('date') }}">

                    </div>


                    {{-- Buttons --}}
                    <div class="col-md-1">

                        <button class="btn btn-primary">
                            Search
                        </button>

                    </div>


                </div>


                <a href="{{ route('activity-logs.index') }}"
                   class="btn btn-secondary mb-3">

                    Reset

                </a>


            </form>



            {{-- Table --}}

            <div class="table-responsive">

                <table class="table table-bordered table-striped">

                    <thead>

                    <tr>

                        <th>
                            #
                        </th>

                        <th>
                            User
                        </th>

                        <th>
                            Module
                        </th>

                        <th>
                            Action
                        </th>

                        <th>
                            Description
                        </th>

                        <th>
                            Date
                        </th>

                        <th>
                            Action
                        </th>

                    </tr>

                    </thead>


                    <tbody>


                    @forelse($activityLogs as $log)


                        <tr>

                            <td>
                                {{ $loop->iteration + ($activityLogs->currentPage()-1)*$activityLogs->perPage() }}
                            </td>


                            <td>

                                {{ $log->user?->name ?? 'System' }}

                            </td>


                            <td>

                                {{ $log->module }}

                            </td>


                            <td>

                                {{ ucfirst($log->action) }}

                            </td>


                            <td>

                                {{ $log->description }}

                            </td>


                            <td>

                                {{ $log->created_at->format('d M Y h:i A') }}

                            </td>


                            <td>

                                <a href="{{ route('activity-logs.show',$log->id) }}"
                                   class="btn btn-sm btn-info">

                                    View

                                </a>

                            </td>


                        </tr>


                    @empty

                        <tr>

                            <td colspan="7"
                                class="text-center">

                                No activity logs found.

                            </td>

                        </tr>

                    @endforelse


                    </tbody>

                </table>


            </div>


            {{-- Pagination --}}

            <div class="mt-3">

                {{ $activityLogs->links() }}

            </div>


        </div>

    </div>

</div>

@endsection