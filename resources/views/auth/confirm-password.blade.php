<x-guest-layout>

    <h3 class="text-center mb-4">
        Confirm Password
    </h3>


    <div class="mb-4 text-muted">

        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}

    </div>



    <form method="POST" action="{{ route('password.confirm') }}">

        @csrf



        <!-- Password -->

        <div class="mb-3">


            <label for="password" class="form-label">

                Password

            </label>



            <input
                id="password"
                class="form-control @error('password') is-invalid @enderror"
                type="password"
                name="password"
                required
                autocomplete="current-password"
                autofocus>


            @error('password')

                <div class="invalid-feedback">

                    {{ $message }}

                </div>

            @enderror


        </div>




        <div class="d-flex justify-content-end">


            <button 
                type="submit"
                class="btn btn-primary">

                Confirm

            </button>


        </div>


    </form>


</x-guest-layout>