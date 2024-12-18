@extends('admin.home')

@section('content')
    <div class="card card-custom my-4 border-0 shadow-sm">
        <div class="card-header bg-light">
            <h5 class="mb-3 md:mb-0">Edit Employee Transfer History</h5>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('transfers.update', $transfer->id) }}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="employee_id">Employee</label>
                    <select name="employee_id" class="form-control" required>
                        <option value="">Select Employee</option>
                        @foreach ($employees as $employee)
                            <option value="{{ $employee->id }}" {{ $transfer->employee_id == $employee->id ? 'selected' : '' }}>{{ $employee->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="branch_id">Branch</label>
                    <select name="branch_id" class="form-control" required>
                        <option value="">Select Branch</option>
                        @foreach ($branches as $branch)
                            <option value="{{ $branch->id }}" {{ $transfer->branch_id == $branch->id ? 'selected' : '' }}>{{ $branch->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="department_id">Department</label>
                    <select name="department_id" class="form-control" required>
                        <option value="">Select Department</option>
                        @foreach ($departments as $department)
                            <option value="{{ $department->id }}" {{ $transfer->department_id == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="rank_id">Rank</label>
                    <select name="rank_id" class="form-control" required>
                        <option value="">Select Rank</option>
                        @foreach ($ranks as $rank)
                            <option value="{{ $rank->id }}" {{ $transfer->rank_id == $rank->id ? 'selected' : '' }}>{{ $rank->rank }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="transfer_date">Transfer Date</label>
                    <input type="date" name="transfer_date" value="{{ $transfer->transfer_date }}" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <input type="text" name="status" value="{{ $transfer->status }}" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Update Transfer</button>
            </form>
        </div>
    </div>
@endsection
