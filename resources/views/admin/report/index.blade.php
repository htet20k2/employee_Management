@extends('admin.home')

@section('content')
<div class="card card-custom my-4 border-0 shadow-sm">
    <div class="card-header bg-light d-flex flex-wrap justify-content-between align-items-center">
        <h5 class="mb-3 md:mb-0">Employee Detail List</h5>

        <!-- Search Box -->
        <form method="get" action="{{ route('reports.index') }}" class="d-flex flex-wrap gap-3 row" id="searchForm">
         

            <div class="form-group">
                <label for="branch">Branch</label>
                <select name="branch" id="branchSelect" class="form-control" onclick="this.form.submit()">
                    <option value="">Select Branch</option>
                    @foreach ($branches as $branch)
                        <option value="{{ $branch->id }}" {{ request('branch') == $branch->id ? 'selected' : '' }}>
                            {{ $branch->name }}
                        </option>
                    @endforeach
                </select>
                
                
            </div>

            <div class="form-group">
                <label for="department" class="form-label">Department</label>
                <select class="form-control" id="department" name="department" onclick="this.form.submit()" >
                    <option value="">Search Department</option>
                    @forelse ($uniqueEmployeeDetails as $uniqueEmployeeDetail)
                        <option value="{{ $uniqueEmployeeDetail->id }}" {{ request('department') == $uniqueEmployeeDetail->id ? 'selected' : '' }}>
                            {{ $uniqueEmployeeDetail->department->name }}
                        </option>
                    @empty
                        <option value="">No departments available for this branch</option>
                    @endforelse
                </select>
            </div>

            <select name="duty" class="form-select col">
                <option value="">Search Duty</option>
                @foreach ($duties as $duty)
                    <option value="{{ $duty->id }}" {{ request('duty') == $duty->id ? 'selected' : '' }}>
                        {{ $duty->duty }}
                    </option>
                @endforeach
            </select>

            <select name="rank" class="form-select col">
                <option value="">Search Rank</option>
                @foreach ($uniqueRankDetails as $uniqueRankDetail)
                    <option value="{{ $uniqueRankDetail->id }}" {{ request('rank') == $uniqueRankDetail->id ? 'selected' : '' }}>
                       {{ $uniqueRankDetail->rank->rank }}
                    </option>
                @endforeach
            </select>

            <select name="is_training" class="form-select col">
                <option value="">Is Training</option>
                <option value="Yes" {{ request('is_training') == 'Yes' ? 'selected' : '' }}>Yes</option>
                <option value="No" {{ request('is_training') == 'No' ? 'selected' : '' }}>No</option>
            </select>

            <div class="col d-flex gap-2 justify-center">
                <button class="btn btn-primary" type="submit">Search</button>
                <a href="{{ route('reports.index') }}" class="btn btn-secondary">Reset</a>
                <a href="{{ route('employeeDetails.export', request()->all()) }}" class="btn btn-success ">
                    Export 
                </a>
            </div>

          
            
        </form>
    </div>

    @if (session('success'))
    <div id="auto-fade-alert" class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card-body p-0">
        <table class="table table-hover">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Image</th>
                    <th>Branch Name</th>
                    <th>Department Name</th>
                    <th>Duty Status</th>
                    <th>Duty Time</th>
                    <th>Rank Name</th>
                    <th>Enroll Date</th>
                    <th>Permanent Date</th>
                    <th>Is Training</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($employeeDetails as $employeedetail)
                    <tr>
                        <td>{{ $employeedetail->id }}</td>
                        <td>
                            @if ($employeedetail->emp_photos)
                                <img src="{{ asset('images/employees/'. $employeedetail->emp_photos) }}" alt="Employee Photo" width="50">
                            @else
                                No Image
                            @endif
                        </td>
                        <td>{{ $employeedetail->branch->name }}</td>
                        <td>{{ $employeedetail->department->name }}</td>
                        <td>{{ $employeedetail->duties->status }}</td>
                        <td>{{ $employeedetail->duties->duty }}</td>
                        <td>{{ $employeedetail->rank->rank }}</td>
                        <td>{{ $employeedetail->enroll_date }}</td>
                        <td>{{ $employeedetail->permanent_date }}</td>
                        <td>{{ $employeedetail->isTraining ? 'Yes' : 'No' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10">No employee data found with the selected filters.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
