@if(isset($designation))
    <form action="{{ route('designations.update', $designation->id) }}" method="POST">
    @method('PUT')
@else
    <form action="{{ route('designations.store') }}" method="POST">
@endif

    @csrf

    <div class="row">

        {{-- Title --}}
        <div class="col-md-6 mb-3">
            <label class="form-label">Designation Title</label>

            <input type="text"
                   name="title"
                   class="form-control @error('title') is-invalid @enderror"
                   value="{{ old('title', $designation->title ?? '') }}"
                   placeholder="Enter Designation Title">

            @error('title')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        {{-- Description --}}
        <div class="col-md-12 mb-3">
            <label class="form-label">Description</label>

            <textarea name="description"
                      class="form-control @error('description') is-invalid @enderror"
                      rows="4"
                      placeholder="Enter Description">{{ old('description', $designation->description ?? '') }}</textarea>

            @error('description')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        {{-- Status --}}
        <div class="col-md-6 mb-3">
            <label class="form-label">Status</label>

            <select name="status"
                    class="form-select @error('status') is-invalid @enderror">

                <option value="1"
                    {{ old('status', $designation->status ?? 1) == 1 ? 'selected' : '' }}>
                    Active
                </option>

                <option value="0"
                    {{ old('status', $designation->status ?? 1) == 0 ? 'selected' : '' }}>
                    Inactive
                </option>

            </select>

            @error('status')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

    </div>

    <div class="mt-3">

        <button type="submit" class="btn btn-primary">
            {{ isset($designation) ? 'Update Designation' : 'Save Designation' }}
        </button>

        <a href="{{ route('designations.index') }}" class="btn btn-secondary">
            Cancel
        </a>

    </div>

</form>