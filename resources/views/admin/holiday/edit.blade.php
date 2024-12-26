@extends('admin.home')

@section('content')
<div class="container">
    <h1>Edit Holiday</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('holidays.update', $holiday->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="holiday">Holiday Date</label>
            <input type="date" name="holiday" id="holiday" class="form-control" value="{{ old('holiday', $holiday->holiday) }}" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" name="description" id="description" class="form-control" value="{{ old('description', $holiday->description) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Holiday</button>
    </form>
</div>
@endsection
