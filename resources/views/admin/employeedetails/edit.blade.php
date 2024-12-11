@extends('admin.home')
@section('content')
    <div class="card card-custom my-4">
        <div class="card-header bg-white">
            <h5 class="mb-3 md:mb-0">Edit Employee</h5>
        </div>
        <div class="card-body">

                    <!-- Form for filtering departments by branch -->
         <form method="GET" action="{{ route('employeedetail.edit', $employeedetail->id ?? '') }}">

            <div class="form-group">
                <label for="branch">Branch</label>
                <select name="branch_id" id="branch" class="form-control" required onchange="this.form.submit()">
                    <option value="">Select Branch</option>
                    @foreach ($branches as $branch)
                        <option value="{{ $branch->id }}" {{ old('branch_id', request('branch_id')) == $branch->id ? 'selected' : '' }}>
                            {{ $branch->name }}
                        </option>
                    @endforeach
                </select>
            </div>
 
            <div class="form-group">
                <label for="department_id" class="form-label">Department</label>
                <select class="form-control" id="department" name="department_id" required onchange="this.form.submit()">
                    <option value="">Select Department</option>
                    @forelse ($departments as $department)
                        <option value="{{ $department->id }}" {{ old('department_id', request('department_id')) == $department->id ? 'selected' : '' }}>
                            {{ $department->name }}
                        </option>
                    @empty
                        <option value="">No departments available for this branch</option>
                    @endforelse
                </select>
            </div>
 
            @if ($errors->any()) <div class="alert alert-danger"> <ul> @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach </ul> </div> @endif
        </form>
      

            <form method="POST" action="{{ route('employeedetail.update', $employeedetail->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')


                    <!-- Hidden Inputs -->
        <input type="hidden" name="branch_id" value="{{ request('branch_id') }}">
        <input type="hidden" name="department_id" value="{{ request('department_id') }}">
        <input type="hidden" name="branchdetail_id" value="{{ old('branchdetail_id', $branchdetail_id ?? '') }}">
   
        <!-- Rank -->
        <div class="mb-3">
            <label for="rank_id" class="form-label">Rank</label>
            <select class="form-control" id="rank_id" name="rank_id" required>
                <option value="">Select Rank</option>
                @foreach ($ranks as $rank)
                    <option value="{{ $rank->id }}" {{ old('rank_id') == $rank->id ? 'selected' : '' }}>
                        {{ $rank->rank }}
                    </option>
                @endforeach
            </select>
        </div>
       
            <!-- Employee Photos -->
            <div class="mb-3">
                <label for="emp_photos" class="form-label">Employee Photos</label>
                <input type="file" class="form-control @error('emp_photos') is-invalid @enderror" id="emp_photos" name="emp_photos" accept="image/*" required>
                @error('emp_photos')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
       
            <!-- Duty Status and Duty Time -->
            <div class="row">
                <div class="mb-3 col">
                    <label for="duty_status" class="form-label">Duty Status</label>
                    <select class="form-control" id="duty_status" name="duty_status" required>
                        <option value="">Select Duty Status</option>
                        @foreach ($dutytimes as $dutytime)
                            <option value="{{ $dutytime->id }}" {{ old('duty_status') == $dutytime->id ? 'selected' : '' }}>
                                {{ $dutytime->status }}
                            </option>
                        @endforeach
                    </select>
                </div>
       
                <div class="mb-3 col">
                    <label for="duty_time" class="form-label">Duty Time</label>
                    <select class="form-control" id="duty_time" name="duty_time_id" required>
                        <option value="">Select Duty Time</option>
                        @foreach ($dutytimes as $dutytime)
                            <option value="{{ $dutytime->id }}" {{ old('duty_time_id') == $dutytime->id ? 'selected' : '' }}>
                                {{ $dutytime->duty }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
       
            <!-- Dates -->
            <div class="row">
                <div class="mb-3 col">
                    <label for="enroll_date" class="form-label">Enroll Date</label>
                    <input type="date" class="form-control @error('enroll_date') is-invalid @enderror" id="enroll_date" name="enroll_date" value="{{ old('enroll_date') }}" required>
                    @error('enroll_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
       
                <div class="mb-3 col">
                    <label for="permanent_date" class="form-label">Permanent Date</label>
                    <input type="date" class="form-control @error('permanent_date') is-invalid @enderror" id="permanent_date" name="permanent_date" value="{{ old('permanent_date') }}" required>
                    @error('permanent_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
       
            <!-- Is Training -->
            <div class="mb-3">
                <label for="isTraining" class="form-label">Is Training</label>
                <select class="form-control" id="isTraining" name="isTraining" required>
                    <option value="0" {{ old('isTraining') == 0 ? 'selected' : '' }}>No</option>
                    <option value="1" {{ old('isTraining') == 1 ? 'selected' : '' }}>Yes</option>
                </select>
            </div>
 
            @if ($errors->any()) <div class="alert alert-danger"> <ul> @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach </ul> </div> @endif
       

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
