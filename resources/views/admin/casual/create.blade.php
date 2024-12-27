@extends('admin.home')

@section('content')
<div class="container">
    <h1>Add New Casual</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('casuals.store') }}" method="POST">
        @csrf
        <select class="form-control" id="employee_id" name="employee_id" required>
            <option value="">Select Employee</option>
            @foreach ($employees as $employee)
                <option value="{{ $employee->employee_id }}" {{ old('employee_id') == $employee->employee_id ? 'selected' : '' }}>
                    {{ $employee->name }}
                </option>
            @endforeach
        </select>

        <div class="form-group">
            <label for="formonth">For Month</label>
            <input type="number" name="formonth" id="formonth" class="form-control" value="{{ old('formonth') }}" required>
        </div>

        <div class="form-group">
            <label for="foryear">For Year</label>
            <input type="number" name="foryear" id="foryear" class="form-control" value="{{ old('foryear') }}" required>
        </div>

        <div class="form-group">
            <label for="count">Count</label>
            <input type="number" name="count" id="count" class="form-control" value="{{ old('count') }}" required>
        </div>

        <div class="mb-3">
            <label for="isTraining" class="form-label">Is Training</label>
            <select class="form-control" id="isTraining" name="isTraining" required>
                <option value="0" {{ old('isTraining') == 0 ? 'selected' : '' }}>No</option>
                <option value="1" {{ old('isTraining') == 1 ? 'selected' : '' }}>Yes</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Add Casual</button>
    </form>
</div>
@endsection
