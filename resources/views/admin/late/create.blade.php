@extends('admin.home')

@section('content')
<div class="container">
    <h1>Add New Late Entry</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('lates.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="employee_id">Employee</label>
            <select name="employee_id" id="employee_id" class="form-control" required>
                <option value="">Select Employee</option>
                @foreach($employees as $employee)
                    <option value="{{ $employee->employee_id }}" {{ old('employee_id') == $employee->employee_id ? 'selected' : '' }}>
                        {{ $employee->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="latedate">Late Date</label>
            <input type="date" name="latedate" id="latedate" class="form-control" value="{{ old('latedate') }}" required>
        </div>

        <div class="form-group">
            <label for="latemin">Late Minutes</label>
            <input type="number" name="latemin" id="latemin" class="form-control" value="{{ old('latemin') }}" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" name="description" id="description" class="form-control" value="{{ old('description') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Add Late Entry</button>
    </form>
</div>
@endsection
