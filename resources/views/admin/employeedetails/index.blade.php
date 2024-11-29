@extends('admin.home')
@section('content')
    <!-- Table Section -->
    <div class="card card-custom my-4 border-0 shadow-sm">
        <div class="card-header bg-light d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Employee Detail List</h5>
            <!-- Search Box -->
            <form method="get" action="{{ route('employeedetail.index') }}" class="mb-3 w-full">
                <div class="input-group d-flex">
                    <!-- Branch Search -->
                    <select class="form-select" id="branch_id" name="search">
                        <option value="">Search Branch</option>
                        @foreach ($branchs as $branch)
                            <option value="{{ $branch->name }}" 
                                {{ request()->input('search') == $branch->name ? 'selected' : '' }}>
                                {{ $branch->name }}
                            </option>
                        @endforeach
                    </select>
            
                    <!-- Duty Time Search -->
                    <select class="form-select" id="duty_time" name="duty_time">
                        <option value="">Search Duty</option>
                        @foreach ($dutytimes as $dutytime)
                            <option value="{{ $dutytime->id }}" 
                                {{ request()->input('duty_time') == $dutytime->id ? 'selected' : '' }}>
                                {{ $dutytime->duty }}
                            </option>
                        @endforeach
                    </select>
            
                    <!-- Department Search -->
                    <select class="form-select" id="department_id" name="department_id">
                        <option value="">Search Department</option>
                        @foreach ($departments as $department)
                            <option value="{{ $department->id }}" 
                                {{ request()->input('department_id') == $department->id ? 'selected' : '' }}>
                                {{ $department->name }}
                            </option>
                        @endforeach
                    </select>
            
                    <!-- Rank Search -->
                    <select class="form-select" id="rank_id" name="rank_id">
                        <option value="">Search Rank</option>
                        @foreach ($ranks as $rank)
                            <option value="{{ $rank->id }}" 
                                {{ request()->input('rank_id') == $rank->id ? 'selected' : '' }}>
                                {{ $rank->rank }}
                            </option>
                        @endforeach
                    </select>
            
                    <!-- Search Button -->
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </form>
            
            <!-- Create Button -->
            <a href="{{ route('employeedetail.create') }}" class="btn btn-sm  btn-primary"><i class="fas fa-plus-circle"></i> Create
                Employee Detail</a>
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
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employeeDetails as $employeeDetail)
                        <tr>
                            <td>{{ ($employeeDetails->currentPage() - 1) * $employeeDetails->perPage() + $loop->index + 1 }}</td>
                            <td>
                                @if ($employeeDetail->emp_photos)
                                    <img src="{{ asset('storage/' . $employeeDetail->emp_photos) }}" alt="Employee Photo" width="50">
                                @else
                                    No Image
                                @endif
                            </td>
                            <td>{{ $employeeDetail->branch->name }}</td>
                            <td>{{ $employeeDetail->department->name }}</td>
                            <td>{{ $employeeDetail->duties->status }}</td>
                            <td>{{ $employeeDetail->duties->duty }}</td>
                            <td>{{ $employeeDetail->rank->rank }}</td>
                            <td>{{ $employeeDetail->enroll_date }}</td>
                            <td>{{ $employeeDetail->permanent_date }}</td>
                            <td>{{ $employeeDetail->isTraining ? 'Yes' : 'No' }}</td>

                            <td>
                                <a href="{{ route('employeedetail.edit', $employeeDetail->id) }}" class="btn btn-sm btn-info"><i
                                        class="fas fa-edit"></i> Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
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
