@extends('admin.home')
@section('content')
    <!-- Table Section -->
    <div class="card shadow-sm border-0">
        <div class="card-header bg-light py-3">
            <div class="row align-items-center">
                <div class="col-md-4">
                    <h5 class="mb-3 md:mb-0">Employee Report List</h5>
                </div>
                <div class="col-md-4">
                    <!-- Search Box -->
                    <form method="get" action="" class="mb-0">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Search..."
                                value="{{ request()->input('search') }}">
                            <button class="btn btn-outline-secondary" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                            <a href="{{ route('details.index') }}" class="btn btn-secondary">Reset</a>
                        </div>
                    </form>
                </div>
               
            </div>
        </div>

        @if (session('success'))
            <div id="auto-fade-alert" class="alert alert-success alert-dismissible fade show m-3" role="alert">
                <i class="fas fa-check-circle me-1"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="bg-light px-4 sticky-col">#</th>
                            <th class="bg-light sticky-col">Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>DOB</th>
                            <th>Sex</th>
                            <th>NRC</th>
                            <th>Address</th>
                            <th>Township</th>
                            <th>Martial Status</th>
                            <th>Father Name</th>
                            <th>Mother Name</th>
                            <th>Race</th>
                            <th>Religious</th>
                            <th>Blood Type</th>
                            <th>Education</th>
                            <th>Other Qualification</th>
                            <th>Description</th>
                            <th>Status</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($employees as $employee)
                        <tr>
                            <td class="px-4 sticky-col">{{ $employee->employee_id }}</td>
                            <td class="sticky-col">{{ $employee->name }}</td>
                            <td>{{ $employee->phone }}</td>
                            <td>{{ $employee->email }}</td>
                            <td>{{ $employee->DOB }}</td>
                            <td><span class="badge bg-info">{{ $employee->sex }}</span></td>
                            <td>{{ $employee->NRC }}</td>
                            <td>{{ $employee->address }}</td>
                            <td>{{ $employee->township }}</td>
                            <td><span class="badge bg-secondary">{{ $employee->martial_status }}</span></td>
                            <td>{{ $employee->father_name }}</td>
                            <td>{{ $employee->mother_name }}</td>
                            <td>{{ $employee->race }}</td>
                            <td>{{ $employee->religious }}</td>
                            <td><span class="badge bg-warning text-dark">{{ $employee->blood_type }}</span></td>
                            <td>{{ $employee->education }}</td>
                            <td>{{ $employee->other_qualification }}</td>
                            <td>{{ $employee->description }}</td>
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
            
                        </tr>
                        @empty
                            <tr>
                                <td colspan="20" class="text-center py-4 text-muted">
                                    <i class="fas fa-inbox fa-2x mb-3 d-block"></i>
                                    No employees found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="card-footer bg-light">
            <div class="d-flex justify-content-end">
                {{ $employees->links() }}
            </div>
        </div>
    </div>
@endsection

@push('styles')
<style>
    .table-responsive {
        overflow-x: auto;
        position: relative;
    }

    .sticky-col {
        position: sticky;
        background: inherit;
        left: 0;
        z-index: 1;
    }

    .sticky-col-right {
        position: sticky;
        background: inherit;
        right: 0;
        z-index: 1;
    }

    /* Shadow effects */
    .sticky-col::after {
        content: '';
        position: absolute;
        top: 0;
        right: -8px;
        width: 8px;
        height: 100%;
        background: linear-gradient(to right, rgba(0,0,0,0.1), transparent);
    }

    .sticky-col-right::before {
        content: '';
        position: absolute;
        top: 0;
        left: -8px;
        width: 8px;
        height: 100%;
        background: linear-gradient(to left, rgba(0,0,0,0.1), transparent);
    }

    .table th, .table td {
        white-space: nowrap;
        vertical-align: middle;
        padding: 0.75rem;
    }

    .badge {
        font-weight: 500;
    }

    /* Hover effect for action buttons */
    .btn-group .btn {
        transition: transform 0.15s ease;
    }

    .btn-group .btn:hover {
        transform: translateY(-1px);
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .card-header .row > div {
            margin-bottom: 1rem;
        }
        .card-header .row > div:last-child {
            margin-bottom: 0;
        }
        .text-end {
            text-align: left !important;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })

    // Auto-hide alert
    setTimeout(function() {
        var alertElement = document.getElementById('auto-fade-alert');
        if (alertElement) {
            var alert = new bootstrap.Alert(alertElement);
            alert.close();
        }
    }, 3000);
</script>
@endpush
