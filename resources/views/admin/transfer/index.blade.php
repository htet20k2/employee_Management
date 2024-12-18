@extends('admin.home')

@section('content')
    <div class="card card-custom my-4 border-0 shadow-sm">
        <div class="card-header bg-light d-flex flex-wrap justify-content-between align-items-center">
            <h5 class="mb-3 md:mb-0">Employee Transfer History</h5>
            <a href="{{ route('transfers.create') }}" class="btn btn-sm btn-primary">Add New Transfer</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card-body p-0">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Employee</th>
                        <th>Branch</th>
                        <th>Department</th>
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
                            <td>{{ $transfer->employee->name }}</td>
                            <td>{{ $transfer->branch->name }}</td>
                            <td>{{ $transfer->department->name }}</td>
                            <td>{{ $transfer->rank->rank }}</td>
                            <td>{{ $transfer->transfer_date }}</td>
                            <td>{{ $transfer->status }}</td>
                            <td>
                                <a href="{{ route('transfers.edit', $transfer->id) }}" class="btn btn-sm btn-info"><i class="fas fa-edit"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
