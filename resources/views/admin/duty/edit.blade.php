@extends('admin.home')
@section('content')
    <div class="card card-custom my-4">
        <div class="card-header bg-white">
            <h5 class="mb-0">Edit Duty</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('duties.update', $duty->id) }}">
                @csrf 
                @method('PUT') 

                <!-- Name Field -->
                <div class="mb-3">
                    <label for="time" class="form-label">Duty Time</label>
                    <input type="time" class="form-control @error('duty') is-invalid @enderror" id="duty"
                        name="duty" placeholder="Enter Duty" value="{{ old('duty',$duty->duty) }}">
                    @error('duty')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>



                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <input type="text" class="form-control @error('status') is-invalid @enderror" id="status"
                        name="status" value="{{ old('status', $duty->status) }}" placeholder="Enter status">
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>


                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('duties.index') }}" class="btn btn-secondary">Back</a>
            </form>
        </div>
    </div>
@endsection