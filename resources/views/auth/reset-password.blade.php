<x-guest-layout>

    <h3 class="text-center mb-4">
        Reset Password
    </h3>


    <form method="POST" action="{{ route('password.store') }}">

        @csrf


        <input type="hidden" 
               name="token" 
               value="{{ $request->route('token') }}">



        <!-- Email -->
        <div class="mb-3">


            <label for="email" class="form-label">

                Email

            </label>


            <input
                id="email"
                class="form-control @error('email') is-invalid @enderror"
                type="email"
                name="email"
                value="{{ old('email', $request->email) }}"
                required
                autofocus
                autocomplete="username">


            @error('email')

                <div class="invalid-feedback">

                    {{ $message }}

                </div>

            @enderror


        </div>




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
                autocomplete="new-password">


            @error('password')

                <div class="invalid-feedback">

                    {{ $message }}

                </div>

            @enderror


        </div>




        <!-- Confirm Password -->
        <div class="mb-3">


            <label for="password_confirmation" class="form-label">

                Confirm Password

            </label>


            <input
                id="password_confirmation"
                class="form-control"
                type="password"
                name="password_confirmation"
                required
                autocomplete="new-password">


        </div>




        <div class="d-flex justify-content-end">


            <button 
                type="submit"
                class="btn btn-primary">

                Reset Password

            </button>


        </div>


    </form>


</x-guest-layout>