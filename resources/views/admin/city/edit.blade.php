@extends('admin.home')
@section('content')
    <div class="card card-custom my-4">
        <div class="card-header bg-white">
            <h5 class="mb-0">Edit City</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('cities.update', $city->id) }}">
                @csrf <!-- CSRF token for security -->
                @method('PUT') <!-- Use the PUT method for updating -->

                <!-- Name Field -->
                <div class="mb-3">
                    <label for="name" class="form-label">City Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        name="name" value="{{ old('name', $city->name) }}" placeholder="Enter City Name">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>


                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('cities.index') }}" class="btn btn-secondary">Back</a>
            </form>
        </div>
    </div>
@endsection
