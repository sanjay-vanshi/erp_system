<form action="{{ route('company-settings.update') }}"
method="POST"
enctype="multipart/form-data">


@csrf

@method('PUT')





{{-- Company Name --}}

<div class="mb-3">


<label class="form-label">

Company Name

</label>



<input

type="text"

name="company_name"

class="form-control @error('company_name') is-invalid @enderror"

value="{{ old('company_name',$company->company_name ?? '') }}"

placeholder="Enter Company Name">


@error('company_name')

<div class="text-danger mt-1">

{{ $message }}

</div>

@enderror


</div>






{{-- Logo --}}

<div class="mb-3">


<label class="form-label">

Company Logo

</label>



<input

type="file"

name="logo"

class="form-control @error('logo') is-invalid @enderror">



@if(isset($company) && $company->logo)


<div class="mt-2">

<img src="{{ asset('storage/'.$company->logo) }}"

width="120">

</div>


@endif



@error('logo')

<div class="text-danger mt-1">

{{ $message }}

</div>

@enderror


</div>







{{-- Email --}}

<div class="mb-3">


<label class="form-label">

Email

</label>


<input

type="email"

name="email"

class="form-control"

value="{{ old('email',$company->email ?? '') }}">


</div>







{{-- Phone --}}

<div class="mb-3">


<label class="form-label">

Phone

</label>


<input

type="text"

name="phone"

class="form-control"

value="{{ old('phone',$company->phone ?? '') }}">


</div>







{{-- Website --}}

<div class="mb-3">


<label class="form-label">

Website

</label>


<input

type="text"

name="website"

class="form-control"

value="{{ old('website',$company->website ?? '') }}">


</div>







{{-- Address --}}

<div class="mb-3">


<label class="form-label">

Address

</label>


<textarea

name="address"

rows="4"

class="form-control">{{ old('address',$company->address ?? '') }}</textarea>


</div>





<button class="btn btn-primary" type="submit">

Save Settings

</button>



</form>