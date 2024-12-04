@extends('admin.home')
@section('content')
    <div class="card card-custom my-4">
        <div class="card-header bg-white">
            <h5 class="mb-3 md:mb-0">Edit Department Details</h5>
        </div>
        <div class="card-body">
      

            <form method="POST" action="{{ route('departmentdetail.update', $departmentdetail->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')


    
                    <div class="mb-3 col">
                        <label for="department_id" class="form-label">Department</label>
                        <select class="form-select" id="department_id" name="department_id" value=">
                            <option value="">Select Department</option>
                            @foreach ($departments as $department)
                                <option value="{{ $department->id }}"
                                    {{ old('department_id', $departmentdetail->department_id) == $department->id ? 'selected' : '' }}>
                                    {{ $department->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>


                <div class="mb-3">
                    <label for="rank_id" class="form-label">Rank</label>
                    <select class="form-select" id="rank_id" name="rank_id"  required>
                        <option value="">Select Rank</option>
                        @foreach ($ranks as $rank)
                            <option value="{{ $rank->id}}" 
                                {{ old('rank_id', $departmentdetail->rank_id) == $rank->id ? 'selected' : '' }}>
                                {{ $rank->rank }}
                            </option>
                        @endforeach
                        

                    </select>
                </div>

                <div class="text-end">
                    <a href="{{ route('departmentdetail.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i>Back
                    </a>
                    <button type="submit" class="btn btn-primary">Update Department Detail</button>
                </div>
            </form>
        </div>
    </div>
@endsection
