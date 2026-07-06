@if(isset($department))
    <form action="{{ route('departments.update', $department->id) }}" method="POST">
    @method('PUT')
@else
    <form action="{{ route('departments.store') }}" method="POST">
@endif



    @csrf

    <div class="mb-3">
        <label class="form-label">Department Name</label>

        <input
    type="text"
    name="name"
    class="form-control @error('name') is-invalid @enderror"
    value="{{ old('name', $department->name ?? '') }}"
    placeholder="Enter Department Name">

@error('name')
    <div class="text-danger mt-1">{{ $message }}</div>
@enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Department Code</label>

        <input
    type="text"
    name="code"
    class="form-control @error('code') is-invalid @enderror"
    value="{{ old('code', $department->code ?? '') }}"
    placeholder="Enter Department Code">

@error('code')
    <div class="text-danger mt-1">{{ $message }}</div>
@enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Description</label>

        <textarea
    name="description"
    class="form-control @error('description') is-invalid @enderror"
    rows="4"
    placeholder="Department Description">{{ old('description', $department->description ?? '') }}</textarea>

@error('description')
    <div class="text-danger mt-1">{{ $message }}</div>
@enderror
    </div>

    <div class="mb-3">

        <label class="form-label">Status</label>

        <select name="status"
        class="form-select @error('status') is-invalid @enderror">

    <option value="1"
        {{ old('status', $department->status ?? 1) == 1 ? 'selected' : '' }}>
        Active
    </option>

    <option value="0"
        {{ old('status', $department->status ?? 1) == 0 ? 'selected' : '' }}>
        Inactive
    </option>

</select>

@error('status')
    <div class="text-danger mt-1">{{ $message }}</div>
@enderror

    </div>

   <button type="submit" class="btn btn-primary">

    {{ isset($department) ? 'Update Department' : 'Save Department' }}

</button>

<a href="{{ route('departments.index') }}" class="btn btn-secondary">
    Cancel
</a>

</form>