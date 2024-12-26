@extends('admin.home')

@section('content')
<div class="container">
    <h1>Holidays</h1>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('holidays.create') }}" class="btn btn-primary mb-3">Add New Holiday</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Holiday Date</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($holidays as $holiday)
                <tr>
                    <td>{{ $holiday->id }}</td>
                    <td>{{ $holiday->holiday }}</td>
                    <td>{{ $holiday->description }}</td>
                    <td>
                        <a href="{{ route('holidays.edit', $holiday->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('holidays.destroy', $holiday->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
