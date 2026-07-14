<x-guest-layout>

    <h3 class="text-center mb-4">
        Login
    </h3>


    <!-- Session Status -->
    <x-auth-session-status 
        class="mb-3" 
        :status="session('status')" 
    />


    <form method="POST" action="{{ route('login') }}">

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
                autocomplete="current-password">


            @error('password')

                <div class="invalid-feedback">

                    {{ $message }}

                </div>

            @enderror


        </div>



        <!-- Remember Me -->
        <div class="mb-3 form-check">


            <input
                id="remember_me"
                type="checkbox"
                class="form-check-input"
                name="remember">


            <label 
                class="form-check-label"
                for="remember_me">

                Remember me

            </label>


        </div>



        <div class="d-flex justify-content-between align-items-center">


            @if (Route::has('password.request'))

                <a 
                    class="text-decoration-none"
                    href="{{ route('password.request') }}">

                    Forgot password?

                </a>

            @endif



            <button 
                type="submit"
                class="btn btn-primary">

                Login

            </button>


        </div>


    </form>


</x-guest-layout>