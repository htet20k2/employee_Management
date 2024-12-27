@extends('admin.home')

@section('content')
<div class="container">
    <h1>Edit Casual</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('casuals.update', $casual->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="employee_id">Employee</label>
            <input type="number" name="employee_id" id="employee_id" class="form-control" value="{{ old('employee_id', $casual->employee_id) }}" required>
        </div>

        <div class="form-group">
            <label for="formonth">For Month</label>
            <input type="number" name="formonth" id="formonth" class="form-control" value="{{ old('formonth',$casual->formonth) }}" required>
        </div>

        <div class="form-group">
            <label for="foryear">For Year</label>
            <input type="number" name="foryear" id="foryear" class="form-control" value="{{ old('foryear', $casual->foryear) }}" required>
        </div>

        <div class="form-group">
            <label for="count">Count</label>
            <input type="number" name="count" id="count" class="form-control" value="{{ old('count', $casual->count) }}" required>
        </div>
        
        <div class="mb-3">
            <label for="isTraining" class="form-label">Is Training</label>
            <select class="form-control" id="isTraining" name="isTraining" required>
                <option value="0" {{ old('isTraining') == 0 ? 'selected' : '' }}>No</option>
                <option value="1" {{ old('isTraining') == 1 ? 'selected' : '' }}>Yes</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Casual</button>
    </form>
</div>
@endsection
