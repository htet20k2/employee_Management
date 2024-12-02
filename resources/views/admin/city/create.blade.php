@extends('admin.home')
@section('content')
    <div class="card card-custom my-4">
        <div class="card-header bg-white">
            <h5 class="mb-3 md:mb-0">Create New City</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('cities.store') }}">
                @csrf <!-- CSRF token for security -->

                <!-- Name Field -->
                <div class="mb-3">
                    <label for="name" class="form-label">City Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        name="name" placeholder="Enter City Name" value="{{ old('name') }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary">Create</button>
                <a href="{{ route('cities.index') }}" class="btn btn-secondary">Back</a>
            </form>

        </div>
    </div>
@endsection
