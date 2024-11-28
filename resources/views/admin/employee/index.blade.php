@extends('admin.home')
@section('content')
    <!-- Table Section -->
    <div class="card card-custom my-4 border-0 shadow-sm">
        <div class="card-header bg-light d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Employee List</h5>
            <!-- Search Box -->
            <form method="get" action="" class="mb-3 w-full">
                <div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="Search..."
                        value="{{ request()->input('search') }}">
                    <button type="submit" class="btn btn-outline-secondary" type="submit" id="button-addon2"><i
                            class="fas fa-search"></i></button>
                </div>
            </form>
            <!-- Create Button -->
            <a href="{{ route('employee.index') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Create
                Employee</a>
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
                        <th>ID</th>
                        <th>Name</th>
                        <th>Contact Info</th>
                        <th>Personal Details</th>
                        <th>Status</th>
                        <th>Education</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($employees as $employee)
                    <tr>
                        <td>{{ $employee->employee_id }}</td>
                        <td>
                            <strong>{{ $employee->name }}</strong><br>
                            <small>NRC: {{ $employee->NRC }}</small>
                        </td>
                        <td>
                            <i class="fas fa-envelope"></i> {{ $employee->email }}<br>
                            <i class="fas fa-phone"></i> {{ $employee->phone }}<br>
                            <small>{{ $employee->address }}, {{ $employee->township }}</small>
                        </td>
                        <td>
                            <span class="badge bg-info">{{ $employee->sex }}</span>
                            <span class="badge bg-secondary">{{ $employee->martial_status }}</span><br>
                            <small>DOB: {{ $employee->DOB->format('d M Y') }}</small><br>
                            <small>Blood: {{ $employee->blood_type }}</small>
                        </td>
                        <td>
                            @php
                                $statusColors = [
                                    'Active' => 'success',
                                    'Inactive' => 'secondary',
                                    'On Leave' => 'warning',
                                    'Terminated' => 'danger',
                                    'Suspended' => 'dark'
                                ];
                            @endphp
                            <span class="badge bg-{{ $statusColors[$employee->status] ?? 'secondary' }}">
                                {{ $employee->status }}
                            </span>
                        </td>
                        <td>
                            {{ $employee->education }}<br>
                            <small>{{ $employee->other_qualification }}</small>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('employee.show', $employee->employee_id) }}" 
                                   class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('employee.edit', $employee->employee_id) }}" 
                                   class="btn btn-sm btn-primary">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('employee.destroy', $employee->employee_id) }}" 
                                      method="POST" 
                                      onsubmit="return confirm('Are you sure you want to delete this employee?');"
                                      class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No employees found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    {{-- {{ $cities->links() }} --}}
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
