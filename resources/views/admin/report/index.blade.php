@extends('admin.home')

@section('content')
<div class="card card-custom my-4 border-0 shadow-sm">
    <div class="card-header bg-light d-flex flex-wrap justify-content-between align-items-center">
        <h5 class="mb-3 md:mb-0">Employee Detail List</h5>

        <!-- Filters -->
        <form method="get" action="{{ route('reports.index') }}" class="d-flex flex-wrap gap-3 row">
            <!-- Branch Filter -->
            <select name="branch" id="branch" class="form-select col">
                <option value="">Select Branch</option>
                @foreach ($branches as $branch)
                    <option value="{{ $branch->id }}" {{ request('branch') == $branch->id ? 'selected' : '' }}>
                        {{ $branch->name }}
                    </option>
                @endforeach
            </select>

            <!-- Department Filter (Initially Disabled) -->
            <select name="department" id="department" class="form-select col" >
                <option value="">Select Department</option>
                @foreach ($departments as $department)
                    <option data-category="{{ $department->branch_id }}" value="{{ $department->id }}" {{ request('department') == $department->id ? 'selected' : '' }}>
                        {{ $department->name }}
                    </option>
                @endforeach
            </select>

            <!-- Duty Filter -->
            <select name="duty" class="form-select col">
                <option value="">Select Duty</option>
                @foreach ($duties as $duty)
                    <option value="{{ $duty->id }}" {{ request('duty') == $duty->id ? 'selected' : '' }}>
                        {{ $duty->duty }}
                    </option>
                @endforeach
            </select>

            <!-- Rank Filter -->
            <select name="rank" class="form-select col" >
                <option value="">Select Rank</option>
                @foreach ($ranks as $rank)
                    <option value="{{ $rank->id }}" {{ request('rank') == $rank->id ? 'selected' : '' }}>
                        {{ $rank->rank }}
                    </option>
                @endforeach
            </select>

            <!-- Training Filter -->
            <select name="is_training" class="form-select col">
                <option value="">Is Training</option>
                <option value="Yes" {{ request('is_training') == 'Yes' ? 'selected' : '' }}>Yes</option>
                <option value="No" {{ request('is_training') == 'No' ? 'selected' : '' }}>No</option>
            </select>

            <!-- Search and Reset Buttons -->
            <div class="col d-flex gap-2">
                <button class="btn btn-primary" type="submit">Search</button>
                <a href="{{ route('reports.index') }}" class="btn btn-secondary">Reset</a>
            </div>
        </form>
    </div>

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
                                <img src="{{ asset('images/' . $employeedetail->emp_photos) }}" alt="Employee Photo" width="50">
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
                        <td>{{ $employeedetail->isTraining ? 'Yes' : 'No' }}
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
