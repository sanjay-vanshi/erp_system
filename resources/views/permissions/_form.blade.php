@if(!empty($permission) && $permission->exists)

<form action="{{ route('permissions.update', $permission) }}" method="POST">

    @method('PUT')

@else

<form action="{{ route('permissions.store') }}" method="POST">

@endif

@csrf


{{-- Permission Name --}}
<div class="mb-3">

    <label class="form-label">

        Permission Name

    </label>

    <input
        type="text"
        name="name"
        class="form-control @error('name') is-invalid @enderror"
        value="{{ old('name', $permission->name ?? '') }}"
        placeholder="Enter permission name">

    @error('name')

        <div class="text-danger mt-1">

            {{ $message }}

        </div>

    @enderror

</div>


<button type="submit" class="btn btn-primary">

    {{ isset($permission) ? 'Update Permission' : 'Create Permission' }}

</button>


<a href="{{ route('permissions.index') }}"
   class="btn btn-secondary">

    Cancel

</a>

</form>