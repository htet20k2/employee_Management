@extends('admin.home')
@section('content')
    <div class="card card-custom my-4">
        <div class="card-header bg-white">
            <h5 class="mb-3 md:mb-0">Edit Department</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('departments.update', $department->id) }}">
                @csrf 
                @method('PUT') 

                <!-- Name Field -->
                <div class="mb-3">
                    <label for="name" class="form-label">Department Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        name="name" value="{{ old('name', $department->name) }}" placeholder="Enter department Name">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="description"
                        name="description" value="{{ old('description', $department->description) }}" placeholder="Enter Description">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>


                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('departments.index') }}" class="btn btn-secondary">Back</a>
            </form>
        </div>
    </div>
@endsection