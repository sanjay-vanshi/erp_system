@extends('layouts.erp')

@section('content')

<div class="container-fluid">


    {{-- Header --}}
    <div class="card shadow-sm mb-3">

        <div class="card-header bg-white d-flex justify-content-between align-items-center">

            <h4 class="mb-0">

                Assign Permissions - {{ $role->name }}

            </h4>


            <a href="{{ route('roles.index') }}"
               class="btn btn-secondary btn-sm">

                Back

            </a>

        </div>

    </div>




    {{-- Permission Form --}}
    <div class="card shadow-sm">

        <div class="card-body">


            <form action="{{ route('roles.permissions.update', $role->id) }}"
                  method="POST">

                @csrf



                <div class="row">


                    @foreach($permissions as $permission)


                        <div class="col-md-4 mb-3">


                            <div class="form-check">


                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    name="permissions[]"
                                    value="{{ $permission->id }}"

                                    {{ $role->permissions->contains($permission->id) ? 'checked' : '' }}
                                >



                                <label class="form-check-label">

                                    {{ ucfirst($permission->name) }}

                                </label>


                            </div>


                        </div>


                    @endforeach


                </div>



                <button type="submit"
                        class="btn btn-primary">

                    Save Permissions

                </button>



            </form>


        </div>

    </div>


</div>

@endsection