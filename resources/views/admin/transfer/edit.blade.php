@extends('admin.home')

@section('content')
    <div class="card card-custom my-4 border-0 shadow-sm">
        <div class="card-header bg-light">
            <h5 class="mb-3 md:mb-0">Edit Employee Transfer History</h5>
        </div>

        <div class="card-body">

            <form method="GET" action="{{ route('transfers.edit',$transfers->id ?? '') }}">
            <div class="form-group">
                <label for="employee_detail_id">Employee</label>
                <select name="employee_detail_id" class="form-control" required onchange="this.form.submit()">
                    <option value="">Select Employee</option>
                    @foreach ($employeeDetails as $detail)
                        <option value="{{ $detail->id }}" {{ request('employee_detail_id') == $detail->id ? 'selected' : '' }}>
                            {{ optional($detail->employees)->name ?? 'No Name' }} 
                            (Branch: {{ optional($detail->branch)->name ?? 'No Branch' }}, 
                            Department: {{ optional($detail->department)->name ?? 'No Department' }})
                        </option>
                    @endforeach
                </select>
            </div>

                        
            <div class="form-group">
                <label for="branch">To Branch</label>
                <select name="branch_id" id="branch" class="form-control" required onchange="this.form.submit()">
                    <option value="">Select Branch</option>
                    @foreach ($branches as $branch)
                        <option value="{{ $branch->id }}" {{ old('branch_id', request('branch_id')) == $branch->id ? 'selected' : '' }}>
                            {{ $branch->name }}
                        </option>
                    @endforeach
                </select>
            </div>

        <div class="form-group">
            <label for="department_id" class="form-label">Department</label>
            <select class="form-control" id="department" name="department_id" required onchange="this.form.submit()">
                <option value="">To Department</option>
                @forelse ($departments as $department)
                    <option value="{{ $department->id }}" {{ old('department_id', request('department_id')) == $department->id ? 'selected' : '' }}>
                        {{ $department->name }}
                    </option>
                @empty
                    <option value="">No departments available for this branch</option>
                @endforelse
            </select>
        </div>
        </form>


        <form method="POST" action="{{ route('transfers.update',$transfer->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <input type="hidden" name="employee_detail_id" value="{{ $transfer->employee_detail_id }}">
                <input type="hidden" name="branch_id" value="{{ $transfer->branch_id }}">
                <input type="hidden" name="department_id" value="{{ $transfer->department_id }}">

                <div class="form-group mt-3">
                    <label for="rank">Rank</label>
                    <select name="rank_id" class="form-control @error('rank_id') is-invalid @enderror" required>
                        <option value="">Select Rank</option>
                        @foreach ($ranks as $rank)
                            <option value="{{ $rank->id }}" {{ $rank->id == $transfer->rank_id ? 'selected' : '' }}>
                                {{ $rank->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('rank_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mt-3">
                    <label for="transfer_date">Transfer Date</label>
                    <input type="date" name="transfer_date" class="form-control @error('transfer_date') is-invalid @enderror" value="{{ $transfer->transfer_date }}" required>
                    @error('transfer_date')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mt-3">
                    <label for="status">Status</label>
                    <input type="text" name="status" class="form-control @error('status') is-invalid @enderror" value="{{ $transfer->status }}" required>
                    @error('status')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success mt-3">Save Changes</button>
            </form>
        </div>
    </div>
@endsection
