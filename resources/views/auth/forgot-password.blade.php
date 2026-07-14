<x-guest-layout>

    <h3 class="text-center mb-4">
        Forgot Password
    </h3>


    <div class="mb-4 text-muted">

        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link.') }}

    </div>



    <!-- Session Status -->
    <x-auth-session-status 
        class="mb-3"
        :status="session('status')" 
    />



    <form method="POST" action="{{ route('password.email') }}">

        @csrf



        <!-- Email Address -->
        <div class="mb-3">


            <label for="email" class="form-label">

                Email

            </label>



            <input
                id="email"
                class="form-control @error('email') is-invalid @enderror"
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
                autofocus>



            @error('email')

                <div class="invalid-feedback">

                    {{ $message }}

                </div>

            @enderror


        </div>



        <div class="d-flex justify-content-end">


            <button 
                type="submit"
                class="btn btn-primary">

                Email Password Reset Link

            </button>


        </div>


    </form>


</x-guest-layout>