@extends('admin.home')

@section('content')
    <div class="card card-custom my-4 border-0 shadow-sm">
        <div class="card-header bg-light d-flex flex-wrap justify-content-between align-items-center">
            <h5 class="mb-3 mb-md-0">Employee Transfer History</h5>
            <a href="{{ route('transfers.create') }}" class="btn btn-sm btn-primary">
                <i class="fas fa-plus"></i> Add New Transfer
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                <strong>Success!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card-body p-0">
            @if ($transfers->isEmpty())
                <div class="p-4 text-center">
                    <p class="mb-0">No transfer records found.</p>
                </div>
            @else
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Employee</th>
                            <th>From Branch</th>
                            <th>From Department</th>
                            <th>To Branch</th>
                            <th>To Department</th>
                            <th>Rank</th>
                            <th>Transfer Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transfers as $transfer)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $transfer->employeeDetail->employee->name ?? 'N/A' }}</td>
                            <td>{{ $transfer->fromBranch->name ?? 'N/A' }}</td>
                            <td>{{ $transfer->fromDepartment->name ?? 'N/A' }}</td>
                            <td>{{ $transfer->branch->name }}</td>
                            <td>{{ $transfer->department->name }}</td>
                            <td>{{ $transfer->rank->rank }}</td>
                            <td>{{ \Carbon\Carbon::parse($transfer->transfer_date)->format('d-m-Y') }}</td>
                            <td>
                                <span class="badge bg-{{ $transfer->status == 'Active' ? 'success' : 'secondary' }}">
                                    {{ $transfer->status }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('transfers.edit', $transfer->id) }}" 
                                   class="btn btn-sm btn-info" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('transfers.destroy', $transfer->id) }}" method="POST" 
                                      class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete this transfer?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="p-3">
                    {{ $transfers->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
