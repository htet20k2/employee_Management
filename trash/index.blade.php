@extends('admin.home')
@section('content')
    <!-- Table Section -->
    <div class="card card-custom my-4 border-0 shadow-sm">
        <div class="card-header bg-light d-flex flex-wrap justify-content-between align-items-center">
            <h5 class="mb-3 md:mb-0">Employee Detail List</h5>
            <!-- Search Box -->
            <form method="get" action="" class="mb-3 w-full">
                <div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="Search..."
                        value="{{ request()->input('search') }}">
                    <button type="submit" class="btn btn-outline-secondary" id="button-addon2"><i
                            class="fas fa-search"></i></button>
                </div>
            </form>
            <!-- Create Button -->
            <a href="{{ route('employeedetail.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Create
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
