@extends('layouts.erp')

@section('content')

<div class="card shadow-sm">

    <div class="card-header bg-white">

        <h4 class="mb-0">
            Reject Leave Request
        </h4>

    </div>


    <div class="card-body">


        <form action="{{ route('leaves.reject',$leave->id) }}"
              method="POST">


            @csrf
            @method('PATCH')


            <div class="mb-3">

                <label class="form-label">
                    Rejection Remarks
                </label>


                <textarea
                    name="remarks"
                    rows="4"
                    class="form-control @error('remarks') is-invalid @enderror"
                    placeholder="Enter rejection reason">{{ old('remarks') }}</textarea>


                @error('remarks')

                    <div class="text-danger mt-1">
                        {{ $message }}
                    </div>

                @enderror


            </div>



            <button type="submit"
                    class="btn btn-danger">

                Reject Leave

            </button>



            <a href="{{ route('leaves.index') }}"
               class="btn btn-secondary">

                Cancel

            </a>


        </form>


    </div>

</div>

@endsection