@extends('admin.home')

@section('content')
<div class="container">
    <h1>Add New Holiday</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('holidays.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="holiday">Holiday Date</label>
            <input type="date" name="holiday" id="holiday" class="form-control" value="{{ old('holiday') }}" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" name="description" id="description" class="form-control" value="{{ old('description') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Add Holiday</button>
    </form>
</div>
@endsection
