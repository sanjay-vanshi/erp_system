@if(!empty($role) && $role->exists)

<form action="{{ route('roles.update', $role) }}" method="POST">
    @method('PUT')

@else

<form action="{{ route('roles.store') }}" method="POST">

@endif

@csrf


{{-- Role Name --}}
<div class="mb-3">

    <label class="form-label">
        Role Name
    </label>

    <input
        type="text"
        name="name"
        class="form-control @error('name') is-invalid @enderror"
        value="{{ old('name', $role->name ?? '') }}"
        placeholder="Enter role name">

    @error('name')

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
        rows="4"
        class="form-control @error('description') is-invalid @enderror"
        placeholder="Enter role description">{{ old('description', $role->description ?? '') }}</textarea>

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

        <option value="">
            Select Status
        </option>

        <option value="Active"
            {{ old('status', $role->status ?? '') == 'Active' ? 'selected' : '' }}>
            Active
        </option>

        <option value="Inactive"
            {{ old('status', $role->status ?? '') == 'Inactive' ? 'selected' : '' }}>
            Inactive
        </option>

    </select>

    @error('status')

        <div class="text-danger mt-1">
            {{ $message }}
        </div>

    @enderror
    <hr>

<h5 class="mb-3">
    Assign Permissions
</h5>

<div class="row">

    @foreach($permissions as $permission)

        <div class="col-md-3 mb-2">

            <div class="form-check">

                <input
                    type="checkbox"
                    class="form-check-input"
                    id="permission{{ $permission->id }}"
                    name="permissions[]"
                    value="{{ $permission->id }}"

                    @checked(
                        in_array(
                            $permission->id,
                            old(
                                'permissions',
                                isset($role)
                                    ? $role->permissions->pluck('id')->toArray()
                                    : []
                            )
                        )
                    )
                >

                <label
                    class="form-check-label"
                    for="permission{{ $permission->id }}">

                    {{ ucfirst($permission->name) }}

                </label>

            </div>

        </div>

    @endforeach

</div>

</div>



<button type="submit" class="btn btn-primary">

    {{ isset($role) ? 'Update Role' : 'Create Role' }}

</button>


<a href="{{ route('roles.index') }}"
   class="btn btn-secondary">

    Cancel

</a>


</form>