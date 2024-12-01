@extends('admin.home')
@section('content')
    <!-- Table Section -->
    <div class="card card-custom my-4 border-0 shadow-sm">
        <div class="card-header bg-light d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Employee Detail List</h5>
            <!-- Search Box -->
            <form method="get" action="{{ route('reports.index') }}" class="d-flex flex-wrap gap-3">
                <select name="branch" class="form-select">
                    <option value="">Search Branch</option>
                    @foreach ($branches as $branch)
                        <option value="{{ $branch->id }}" {{ request('branch') == $branch->id ? 'selected' : '' }}>
                            {{ $branch->name }}
                        </option>
                    @endforeach
                </select>
            
                <select name="department" class="form-select">
                    <option value="">Search Department</option>
                    @foreach ($departments as $department)
                        <option value="{{ $department->id }}" {{ request('department') == $department->id ? 'selected' : '' }}>
                            {{ $department->name }}
                        </option>
                    @endforeach
                </select>
            
                <select name="duty_status" class="form-select">
                    <option value="">Search Duty</option>
                    <option value="MORNING" {{ request('duty_status') == 'MORNING' ? 'selected' : '' }}>Morning</option>
                    <option value="EVENING" {{ request('duty_status') == 'EVENING' ? 'selected' : '' }}>Evening</option>
                </select>
            
                <select name="rank" class="form-select">
                    <option value="">Search Rank</option>
                    @foreach ($ranks as $rank)
                        <option value="{{ $rank->id }}" {{ request('rank') == $rank->id ? 'selected' : '' }}>
                            {{ $rank->rank }}
                        </option>
                    @endforeach
                </select>
            
                <select name="is_training" class="form-select">
                    <option value="">Is Training</option>
                    <option value="Yes" {{ request('is_training') == 'Yes' ? 'selected' : '' }}>Yes</option>
                    <option value="No" {{ request('is_training') == 'No' ? 'selected' : '' }}>No</option>
                </select>
            
                <button class="btn btn-primary" type="submit">Search</button>
                <a href="{{ route('reports.index') }}" class="btn btn-secondary">Reset</a>
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
                            
                            <td>
                                @if ($employeedetail->emp_photos)
                                    <img src="{{ asset('storage/' . $employeedetail->emp_photos) }}" alt="Employee Photo" width="50">
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
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination Links -->
            <div class="mt-3">
                {{ $employeeDetails->links() }}
            </div>
            
        </div>
    </div>
    {{-- {{ $employeeDetails->links() }} --}}
@endsection

<script>
    setTimeout(function() {
        var alertElement = document.getElementById('auto-fade-alert');
        if (alertElement) {
            var alert = new bootstrap.Alert(alertElement);
            alert.close();
        }
    }, 1000);
</script>
