@extends('admin.home')

@section('content')
    <div class="card card-custom my-4 border-0 shadow-sm">
        <div class="card-header bg-light">
            <h5 class="mb-3 md:mb-0">Create Employee Transfer History</h5>
        </div>

        

        <div class="card-body">

                    <!-- Form for filtering departments by branch -->
        <form method="GET" action="{{ route('transfers.create') }}">
            <div class="form-group">
                <label for="branch">Branch</label>
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
                    <option value="">Select Department</option>
                    @forelse ($departments as $department)
                        <option value="{{ $department->id }}" {{ old('department_id', request('department_id')) == $department->id ? 'selected' : '' }}>
                            {{ $department->name }}
                        </option>
                    @empty
                        <option value="">No departments available for this branch</option>
                    @endforelse
                </select>
            </div>
 
            @if ($errors->any()) <div class="alert alert-danger"> <ul> @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach </ul> </div> @endif
        </form>

            
            <form method="POST" action="{{ route('transfers.store') }}">
                @csrf

                       <!-- Hidden Inputs -->
        <input type="hidden" name="branch_id" value="{{ request('branch_id') }}">
        <input type="hidden" name="department_id" value="{{ request('department_id') }}">
        <input type="hidden" name="branchdetail_id" value="{{ old('branchdetail_id', $branchdetail_id ?? '') }}">
   
        <!-- Rank -->
        <div class="mb-3">
            <label for="rank_id" class="form-label">Rank</label>
            <select class="form-control" id="rank_id" name="rank_id" required>
                <option value="">Select Rank</option>
                @foreach ($ranks as $rank)
                    <option value="{{ $rank->id }}" {{ old('rank_id') == $rank->id ? 'selected' : '' }}>
                        {{ $rank->rank }}
                    </option>
                @endforeach
            </select>
        </div>

                <div class="form-group mt-3">
                    <label for="employee_id">Employee</label>
                    <select name="employee_id" class="form-control" required>
                        <option value="">Select Employee</option>
                        @foreach ($employees as $employee)
                            <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                        @endforeach
                    </select>
                </div>
                {{-- <div class="form-group mt-3">
                    <label for="branch_id">Branch</label>
                    <select name="branch_id" class="form-control" required>
                        <option value="">Select Branch</option>
                        @foreach ($branches as $branch)
                            <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mt-3">
                    <label for="department_id">Department</label>
                    <select name="department_id" class="form-control" required>
                        <option value="">Select Department</option>
                        @foreach ($departments as $department)
                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mt-3">
                    <label for="rank_id">Rank</label>
                    <select name="rank_id" class="form-control" required>
                        <option value="">Select Rank</option>
                        @foreach ($ranks as $rank)
                            <option value="{{ $rank->id }}">{{ $rank->rank }}</option>
                        @endforeach
                    </select>
                </div> --}}
                <div class="form-group mt-3">
                    <label for="transfer_date">Transfer Date</label>
                    <input type="date" name="transfer_date" class="form-control" required>
                </div>
                <div class="form-group mt-3">
                    <label for="status">Status</label>
                    <input type="text" name="status" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success mt-3">Save Transfer</button>
            </form>
        </div>
    </div>
@endsection
