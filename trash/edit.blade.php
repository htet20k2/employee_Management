@extends('admin.home')
@section('content')
    <div class="card card-custom my-4">
        <div class="card-header bg-white">
            <h5 class="mb-3 md:mb-0">Edit Employee</h5>
        </div>
        <div class="card-body">
      

            <form method="POST" action="{{ route('employeedetail.update', $employeedetail->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')


                <div class="mb-3">
                    <label for="emp_photos" class="form-label">Employee Photos</label>
                    <input type="file" class="form-control @error('emp_photos') is-invalid @enderror" id="emp_photos"
                        name="emp_photos" accept="image/*" value="{{ old('emp_photos', $employeedetail->emp_photos) }}">
                    @error('emp_photos')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="mb-3 col">
                        <label for="branch_id" class="form-label">Branch</label>
                        <select class="form-select" id="branch_id" name="branch_id">
                            <option  value="">Select Branch</option>
                            @foreach ($branchs as $branch)
                                <option value="{{ old('branch_id', $branch->branch_id) }}"
                                    {{ old('branch_id') == $branch->branch_id ? 'selected' : '' }}>
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
                                <option value="{{ old('department_id', $department->department_id) }}"
                                    {{ old('department_id') == $department->department_id ? 'selected' : '' }}>
                                    {{ $department->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="mb-3 col">
                        <label for="duty_status" class="form-label">Duty Status</label>
                        <select class="form-select" id="duty_status" name="duty_status" >
                            <option>Select Duty Status</option>
                            @foreach ($dutytimes as $dutytime)
                                <option value="{{ $dutytime->id }}"
                                    {{ old('duty_time_id', $employeedetail->duty_time_id) == $dutytime->id ? 'selected' : '' }}>
                                    {{ $dutytime->status }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3 col">
                        <label for="duty_time" class="form-label">Duty Time</label>
                        <select class="form-select" id="duty_time" name="duty_time">
                            <option value="">Select Duty Time</option>
                            @foreach ($dutytimes as $dutytime)
                                <option value="{{ $dutytime->id }}"
                                    {{ old('duty_time_id', $employeedetail->duty_time_id) == $dutytime->id ? 'selected' : '' }}>
                                    {{ $dutytime->duty }}
                                </option>
                            @endforeach

            
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="mb-3 col">
                        <label for="enroll_date" class="form-label">Enroll Date</label>
                        <input type="date" class="form-control @error('enroll_date') is-invalid @enderror" id="enroll_date"
                            name="enroll_date" value="{{ old('enroll_date', $employeedetail->enroll_date)}}">
                        @error('enroll_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
    
                    <div class="mb-3 col">
                        <label for="permanent_date" class="form-label">Permanent Date</label>
                        <input type="date" class="form-control @error('permanent_date') is-invalid @enderror" id="permanent_date"
                            name="permanent_date" value="{{ old('permanent_date', $employeedetail->permanent_date)}}">
                        @error('permanent_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="isTraining" class="form-label">Is Training</label>
                    <select class="form-select" id="isTraining" name="isTraining"  required>
                        <option value="{{ old('isTraining', $employeedetail->isTraining)}}">Select Rank</option>

                        <option value="0" {{ old('isTraining') == 0 ? 'selected' : '' }}>No</option>
                        <option value="1" {{ old('isTraining') == 1 ? 'selected' : '' }}>Yes</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="rank_id" class="form-label">Rank</label>
                    <select class="form-select" id="rank_id" name="rank_id"  required>
                        <option value="">Select Rank</option>
                        @foreach ($ranks as $rank)
                            <option value="{{ $rank->id}}" 
                                {{ old('rank_id', $employeedetail->rank_id) == $rank->id ? 'selected' : '' }}>
                                {{ $rank->rank }}
                            </option>
                        @endforeach
                        

                    </select>
                </div>

                <div class="text-end">
                    <a href="{{ route('employeedetail.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i>Back
                    </a>
                    <button type="submit" class="btn btn-primary">Update Employee Detail</button>
                </div>
            </form>
        </div>
    </div>
@endsection
