@extends('admin.home')
@section('content')
    <div class="card card-custom my-4">
        <div class="card-header bg-white">
            <h5 class="mb-3 md:mb-0">Create New Branch</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('branches.store') }}">
                @csrf


                <div class="mb-3">
                    <label for="name" class="form-label">Branch Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        name="name" placeholder="Enter branch Name" value="{{ old('name') }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label">Address</label>
                    <input type="text" class="form-control @error('address') is-invalid @enderror" id="address"
                        name="address" placeholder="Enter branch Name" value="{{ old('address') }}">
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary">Create</button>
                <a href="{{ route('branches.index') }}" class="btn btn-secondary">Back</a>
            </form>

        </div>
    </div>

    @endsection