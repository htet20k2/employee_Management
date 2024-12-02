@extends('admin.home')
@section('content')
    <div class="card card-custom my-4 border-0 shadow-sm">
        <div class="card-header bg-light">
            <h5 class="mb-3 md:mb-0">Create Employee Detail</h5>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('employeedetail.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="emp_photos" class="form-label">Employee Photos</label>
                    <input type="file" class="form-control @error('emp_photos') is-invalid @enderror" id="emp_photos"
                        name="emp_photos" accept="image/*">
                    @error('emp_photos')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

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

                <div class="row">
                    <div class="mb-3 col">
                        <label for="duty_status" class="form-label">Duty Status</label>
                        <select class="form-select" id="duty_status" name="duty_status" required>
                            <option value="">Select Duty Status</option>
                            @foreach ($dutytimes as $dutytime)
                                <option value="{{ $dutytime->id }}"
                                    {{ old('duty_status') == $dutytime->id ? 'selected' : '' }}>
                                    {{ $dutytime->status }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3 col">
                        <label for="duty_time" class="form-label">Duty Time</label>
                        <select class="form-select" id="duty_time" name="duty_time" required>
                            <option value="">Select Duty Time</option>
                            @foreach ($dutytimes as $dutytime)
                                <option value="{{ $dutytime->id }}"
                                    {{ old('duty_time') == $dutytime->id ? 'selected' : '' }}>
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
                            name="enroll_date" value="{{ old('enroll_date') }}" required>
                        @error('enroll_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
    
                    <div class="mb-3 col">
                        <label for="permanent_date" class="form-label">Permanent Date</label>
                        <input type="date" class="form-control @error('permanent_date') is-invalid @enderror" id="permanent_date"
                            name="permanent_date" value="{{ old('permanent_date') }}" required>
                        @error('permanent_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="isTraining" class="form-label">Is Training</label>
                    <select class="form-select" id="isTraining" name="isTraining" required>
                        <option value="0" {{ old('isTraining') == 0 ? 'selected' : '' }}>No</option>
                        <option value="1" {{ old('isTraining') == 1 ? 'selected' : '' }}>Yes</option>
                    </select>
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

                <button type="submit" class="btn btn-primary">Create Employee Detail</button>
            </form>
        </div>
    </div>
@endsection
