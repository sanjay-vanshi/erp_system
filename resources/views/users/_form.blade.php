@if(!empty($user) && $user->exists)

<form action="{{ route('users.update', $user) }}" method="POST">

    @method('PUT')

@else

<form action="{{ route('users.store') }}" method="POST">

@endif

@csrf
{{-- Employee --}}

<div class="mb-3">

    <label class="form-label">

        Employee

    </label>

    <select
        name="employee_id"
        id="employee_id"
        class="form-select @error('employee_id') is-invalid @enderror">

        <option value="">

            Select Employee

        </option>

        @foreach($employees as $employee)

            <option
                value="{{ $employee->id }}"
                data-name="{{ $employee->first_name }} {{ $employee->last_name }}"
                {{ old('employee_id', $user->employee_id ?? '') == $employee->id ? 'selected' : '' }}>

                {{ $employee->employee_code }}
                -
                {{ $employee->first_name }}
                {{ $employee->last_name }}

            </option>

        @endforeach

    </select>

    @error('employee_id')

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
        class="form-control @error('email') is-invalid @enderror"
        value="{{ old('email', $user->email ?? '') }}">

    @error('email')

        <div class="text-danger mt-1">

            {{ $message }}

        </div>

    @enderror

</div>
{{-- Role --}}

<div class="mb-3">

    <label class="form-label">

        Role

    </label>

    <select
        name="role_id"
        class="form-select @error('role_id') is-invalid @enderror">

        <option value="">

            Select Role

        </option>

        @foreach($roles as $role)

            <option
                value="{{ $role->id }}"
                {{ old('role_id', $user->role_id ?? '') == $role->id ? 'selected' : '' }}>

                {{ $role->name }}

            </option>

        @endforeach

    </select>

    @error('role_id')

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

        <option
            value="Active"
            {{ old('status', $user->status ?? 'Active') == 'Active' ? 'selected' : '' }}>

            Active

        </option>

        <option
            value="Inactive"
            {{ old('status', $user->status ?? '') == 'Inactive' ? 'selected' : '' }}>

            Inactive

        </option>

    </select>

    @error('status')

        <div class="text-danger mt-1">

            {{ $message }}

        </div>

    @enderror

</div>
{{-- Password --}}

<div class="mb-3">

    <label class="form-label">

        Password

    </label>

    <input
        type="password"
        name="password"
        class="form-control @error('password') is-invalid @enderror">

    @error('password')

        <div class="text-danger mt-1">

            {{ $message }}

        </div>

    @enderror

</div>
{{-- Confirm Password --}}

<div class="mb-3">

    <label class="form-label">

        Confirm Password

    </label>

    <input
        type="password"
        name="password_confirmation"
        class="form-control">

</div>
<button
    type="submit"
    class="btn btn-primary">

    {{ isset($user) ? 'Update User' : 'Create User' }}

</button>

<a
    href="{{ route('users.index') }}"
    class="btn btn-secondary">

    Cancel

</a>

</form>