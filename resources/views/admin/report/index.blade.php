@extends('admin.home')
@section('content')
    <!-- Table Section -->
    <div class="card card-custom my-4 border-0 shadow-sm">
        <div class="card-header bg-light d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Employee Detail List</h5>
            <!-- Search Box -->
            <form method="get" action="{{ route('reports.index') }}" class="mb-3 w-full">
                <div class="input-group d-flex">
                    <!-- Branch Search -->
                    <select class="form-select" id="branch_id" name="search">
                        <option value="">Search Branch</option>
                        @foreach ($employeedetaiils as $employeedetail)
                            <option value="{{ $employeedetail->branch->id }}" 
                                {{ request()->input('search') == $employeedetail->branch->id ? 'selected' : '' }}>
                                {{ $employeedetail->branch->name }}
                            </option>
                        @endforeach
                    </select>
                    
            
                  <!-- Duty Time Search -->
<select class="form-select" id="duty_time" name="duty_time">
    <option value="">Search Duty</option>
    @foreach ($employeedetaiils as $employeedetail)
        <option value="{{ $employeedetail->duties->id }}" 
            {{ request()->input('duty_time') == $employeedetail->duties->id ? 'selected' : '' }}>
            {{ $employeedetail->duties->duty }}
        </option>
    @endforeach
</select>

<!-- Department Search -->
<select class="form-select" id="department_id" name="department_id">
    <option value="">Search Department</option>
    @foreach ($employeedetaiils as $employeedetail)
        <option value="{{ $employeedetail->department->id }}" 
            {{ request()->input('department_id') == $employeedetail->department->id ? 'selected' : '' }}>
            {{ $employeedetail->department->name }}
        </option>
    @endforeach
</select>

<!-- Rank Search -->
<select class="form-select" id="rank_id" name="rank_id">
    <option value="">Search Rank</option>
    @foreach ($employeedetaiils as $employeedetail)
        <option value="{{ $employeedetail->rank->id }}" 
            {{ request()->input('rank_id') == $employeedetail->rank->id ? 'selected' : '' }}>
            {{ $employeedetail->rank->rank }}
        </option>
    @endforeach
</select>

            
                    <!-- Search Button -->
                    <button type="submit" class="btn btn-primary">Search</button>
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
                    @foreach ($employeedetaiils as $employeedetail)
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
        </div>
    </div>
    {{-- {{ $employeedetaiils->links() }} --}}
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
