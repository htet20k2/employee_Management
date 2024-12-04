@extends('admin.home')
@section('content')
    <div class="card card-custom my-4 border-0 shadow-sm">
        <div class="card-header bg-light">
            <h5 class="mb-3 md:mb-0">Create Department Detail</h5>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('departmentdetail.store') }}" enctype="multipart/form-data">
                @csrf


    
                    <div class="mb-3 col">
                        <label for="department_id" class="form-label">Department</label>
                        <select class="form-select" id="department_id" name="department_id" required>
                            <option value="">Select Department</option>
                            @foreach ($departments as $department)
                                <option value="{{ $department->id }}"
                                    {{ old('department_id') == $department->id ? 'selected' : '' }}>
                                    {{ $department->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

 
                <div class="mb-3">
                    <label for="rank_id" class="form-label">Rank</label>
                    <select class="form-select" id="rank_id" name="rank_id" required>
                        <option value="">Select Rank</option>
                        @foreach ($ranks as $rank)
                            <option value="{{ $rank->id }}"
                                {{ old('rank_id') == $rank->id ? 'selected' : '' }}>
                                {{ $rank->rank }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Create Department Detail</button>
            </form>
        </div>
    </div>
@endsection
