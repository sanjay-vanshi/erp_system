@if(isset($holiday))

    <form action="{{ route('holidays.update', $holiday->id) }}" method="POST">

    @method('PUT')

@else

    <form action="{{ route('holidays.store') }}" method="POST">

@endif



@csrf



{{-- Holiday Name --}}

<div class="mb-3">

    <label class="form-label">
        Holiday Name
    </label>


    <input
    type="text"
    name="name"
    class="form-control @error('name') is-invalid @enderror"
    value="{{ old('name', $holiday->name ?? '') }}"
    placeholder="Enter Holiday Name">


    @error('name')

        <div class="text-danger mt-1">
            {{ $message }}
        </div>

    @enderror


</div>




{{-- Holiday Date --}}

<div class="mb-3">


    <label class="form-label">
        Holiday Date
    </label>



   <input
type="date"
name="holiday_date"
class="form-control @error('holiday_date') is-invalid @enderror"
value="{{ old('holiday_date', isset($holiday) ? $holiday->holiday_date->format('Y-m-d') : '') }}">



    @error('holiday_date')

        <div class="text-danger mt-1">
            {{ $message }}
        </div>

    @enderror


</div>




{{-- Description --}}

<div class="mb-3">


    <label class="form-label">
        Description
    </label>



    <textarea
    name="description"
    class="form-control @error('description') is-invalid @enderror"
    rows="4"
    placeholder="Holiday Description">{{ old('description', $holiday->description ?? '') }}</textarea>



    @error('description')

        <div class="text-danger mt-1">
            {{ $message }}
        </div>

    @enderror



</div>




{{-- Status --}}

<div class="mb-3">


<label class="form-label">
    Status
</label>



<select 
name="status"
class="form-select @error('status') is-invalid @enderror">



<option value="active"
{{ old('status', $holiday->status ?? 1) == 1 ? 'selected' : '' }}>

Active

</option>



<option value="inactive"
{{ old('status', $holiday->status ?? 1) == 0 ? 'selected' : '' }}>

Inactive

</option>



</select>



@error('status')

<div class="text-danger mt-1">
    {{ $message }}
</div>

@enderror



</div>




<button type="submit" class="btn btn-primary">


{{ isset($holiday) ? 'Update Holiday' : 'Save Holiday' }}


</button>



<a href="{{ route('holidays.index') }}" 
class="btn btn-secondary">

Cancel

</a>



</form>