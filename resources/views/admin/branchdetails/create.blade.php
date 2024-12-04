@extends('admin.home')
@section('content')
    <div class="card card-custom my-4 border-0 shadow-sm">
        <div class="card-header bg-light">
            <h5 class="mb-3 md:mb-0">Create Branch Detail</h5>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('branchdetail.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="mb-3 col">
                        <label for="branch_id" class="form-label">Branch</label>
                        <select class="form-select" id="branch_id" name="branch_id" required>
                            <option value="">Select Branch</option>
                            @foreach ($branchs as $branch)
                                <option value="{{ $branch->id }}"
                                    {{ old('branch_id') == $branch->id ? 'selected' : '' }}>
                                    {{ $branch->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
    
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



                <button type="submit" class="btn btn-primary">Create Branch Detail</button>
            </form>
        </div>
    </div>
@endsection
