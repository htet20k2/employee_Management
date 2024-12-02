@extends('admin.home')

@section('content')
<div class="card card-custom my-4 border-0 shadow-sm">
    <div class="card-header bg-light d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Employee Detail List</h5>
        
        <form method="get" action="{{ route('reports.index') }}" class="d-flex flex-wrap gap-3">
            <!-- Branch Filter -->
            <div class="col-md-3">
                <label for="branch">Branch</label>
                <select class="form-select" name="branch" id="branch">
                    <option value="">All Branches</option>
                    @foreach ($branches as $branch)
                        <option value="{{ $branch->id }}" {{ request('branch') == $branch->id ? 'selected' : '' }}>
                            {{ $branch->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Department Filter -->
            <div class="col-md-3">
                <label for="department">Department</label>
                <select class="form-select" name="department" id="department">
                    <option value="">All Departments</option>
                    @foreach ($departments as $department)
                        <option value="{{ $department->id }}" {{ request('department') == $department->id ? 'selected' : '' }}>
                            {{ $department->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Rank Filter -->
            <div class="col-md-3">
                <label for="rank">Rank</label>
                <select class="form-select" name="rank" id="rank">
                    <option value="">All Ranks</option>
                    @foreach ($ranks as $rank)
                        <option value="{{ $rank->id }}" {{ request('rank') == $rank->id ? 'selected' : '' }}>
                            {{ $rank->rank }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Duty Filter -->
            <div class="col-md-3">
                <label for="duty">Duty</label>
                <select class="form-select" name="duty" id="duty">
                    <option value="">All Duties</option>
                    @foreach ($duties as $duty)
                        <option value="{{ $duty->id }}" {{ request('duty') == $duty->id ? 'selected' : '' }}>
                            {{ $duty->duty }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Is Training Filter -->
            <div class="col-md-3">
                <label for="is_training">Is Training</label>
                <select class="form-select" name="is_training" id="is_training">
                    <option value="">Select Training Status</option>
                    <option value="Yes" {{ request('is_training') == 'Yes' ? 'selected' : '' }}>Yes</option>
                    <option value="No" {{ request('is_training') == 'No' ? 'selected' : '' }}>No</option>
                </select>
            </div>

            <!-- Search and Reset Buttons -->
            <div class="col-md-3">
                <button class="btn btn-primary" type="submit">Search</button>
                <a href="{{ route('reports.index') }}" class="btn btn-secondary">Reset</a>
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
                @foreach ($employeeDetails as $employeedetail)
                <tr>
                    <td>{{ $employeedetail->id }}</td>
                    <td>@if ($employeedetail->emp_photos) 
                        <img src="{{ asset('storage/' . $employeedetail->emp_photos) }}" alt="Employee Photo" width="50"> 
                        @else No Image 
                        @endif
                    </td>
                    <td>{{ optional($employeedetail->branch)->name }}</td>
                    <td>{{ optional($employeedetail->department)->name }}</td>
                    <!-- Assuming duties relationship returns a single duty -->
                    <td>{{ optional($employeedetail->duties)->status }}</td> 
                    <!-- Assuming duties relationship returns a single duty -->
                    <td>{{ optional($employeedetail->duties)->duty }}</td> 
                    ...
                    <!-- Assuming rank relationship returns a single rank -->
                    <td>{{ optional($employeedetail->rank)->rank }}</td> 
                    <!-- Dates -->
                    <td>{{ optional($employeedetail)->enroll_date }}</td> 
                    <td>{{ optional($employeedetail)->permanent_date }}</td> 
                    <!-- Is Training -->
                    <td>{{ optional($employeedetail)->isTraining ? 'Yes' : 'No' }}</td> 
                </tr>
                @endforeach
            </tbody>

        </table>

        <!-- Pagination Links -->
        {{ $employeeDetails->links() }}
    </div>

</div>

<script>
// Auto fade alert after 1 second
setTimeout(function() {
    var alertElement = document.getElementById('auto-fade-alert');
    if (alertElement) {
        var alert = new bootstrap.Alert(alertElement);
        alert.close();
    }
}, 1000);
</script>

@endsection