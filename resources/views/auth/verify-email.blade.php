<x-guest-layout>

    <h3 class="text-center mb-4">
        Verify Email
    </h3>


    <div class="mb-4 text-muted">

        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn’t receive the email, we will gladly send you another.') }}

    </div>



    @if (session('status') == 'verification-link-sent')

        <div class="alert alert-success mb-3">

            {{ __('A new verification link has been sent to your email address.') }}

        </div>

    @endif



    <div class="d-flex justify-content-between align-items-center">


        <!-- Resend Verification Email -->

        <form method="POST" action="{{ route('verification.send') }}">

            @csrf


            <button 
                type="submit"
                class="btn btn-primary">

                Resend Verification Email

            </button>


        </form>




        <!-- Logout -->

        <form method="POST" action="{{ route('logout') }}">

            @csrf


            <button 
                type="submit"
                class="btn btn-outline-danger">

                Logout

            </button>


        </form>


    </div>


</x-guest-layout>