@extends('admin.home')

@section('content')
<div class="container">
    <h1>Edit Late Entry</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('lates.update', $late->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="employee_id">Employee</label>
            <select name="employee_id" id="employee_id" class="form-control" required>
                <option value="">Select Employee</option>
                @foreach($employees as $employee)
                    <option value="{{ $employee->employee_id }}" {{ $late->employee_id == $employee->employee_id ? 'selected' : '' }}>
                        {{ $employee->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="latedate">Late Date</label>
            <input type="date" name="latedate" id="latedate" class="form-control" value="{{ old('latedate', $late->latedate) }}" required>
        </div>

        <div class="form-group">
            <label for="latemin">Late Minutes</label>
            <input type="number" name="latemin" id="latemin" class="form-control" value="{{ old('latemin', $late->latemin) }}" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" name="description" id="description" class="form-control" value="{{ old('description', $late->description) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Late Entry</button>
    </form>
</div>
@endsection
