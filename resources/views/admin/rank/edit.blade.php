@extends('admin.home')
@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-light py-3">
        <div class="row align-items-center">
            <div class="col">
                <h5 class="mb-3 md:mb-0">Edit Rank</h5>
            </div>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('rank.update', $rank->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                            id="name" name="name" value="{{ old('name', $rank->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="rank" class="form-label">Rank</label>
                        <input type="text" class="form-control @error('rank') is-invalid @enderror" 
                            id="rank" name="rank" value="{{ old('rank', $rank->rank) }}" required>
                        @error('rank')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="text-end">
                <a href="{{ route('rank.index') }}" class="btn btn-secondary">Back</a>
                <button type="submit" class="btn btn-primary">Update Rank</button>
            </div>
        </form>
    </div>
</div>
@endsection 