@extends('admin.home')
@section('content')
    <div class="card card-custom my-4">
        <div class="card-header bg-white">
            <h5 class="mb-3 md:mb-0">Edit Branch Detail</h5>
        </div>
        <div class="card-body">
      

            <form method="POST" action="{{ route('branchdetail.update', $branchdetail->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')


 

                <div class="row">
                    <div class="mb-3 col">
                        <label for="branch_id" class="form-label">Branch</label>
                        <select class="form-select" id="branch_id" name="branch_id">
                            <option  value="">Select Branch</option>
                            @foreach ($branchs as $branch)
                                <option value="{{ $branch->id }}"
                                    {{ old('branch_id', $branchdetail->branch_id) == $branch->id ? 'selected' : '' }}>
                                    {{ $branch->name }}
                                </option>


                            @endforeach
                        </select>
                    </div>
    
                    <div class="mb-3 col">
                        <label for="department_id" class="form-label">Department</label>
                        <select class="form-select" id="department_id" name="department_id" value=">
                            <option value="">Select Department</option>
                            @foreach ($departments as $department)
                                <option value="{{ $department->id }}"
                                    {{ old('department_id', $branchdetail->department_id) == $department->id ? 'selected' : '' }}>
                                    {{ $department->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>


                <div class="text-end">
                    <a href="{{ route('branchdetail.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i>Back
                    </a>
                    <button type="submit" class="btn btn-primary">Update Branch Detail</button>
                </div>
            </form>
        </div>
    </div>
@endsection
