@extends('admin.home')

@section('content')
<div class="container">
    <h1>Late Entries</h1>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('lates.create') }}" class="btn btn-primary mb-3">Add New Late Entry</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Employee</th>
                <th>Late Date</th>
                <th>Late Minutes</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($lates as $late)
                <tr>
                    <td>{{ $late->id }}</td>
                    <td>{{ $late->employee->name ?? 'N/A' }}</td>
                    <td>{{ $late->latedate }}</td>
                    <td>{{ $late->latemin }}</td>
                    <td>{{ $late->description }}</td>
                    <td>
                        <a href="{{ route('lates.edit', $late->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('lates.destroy', $late->id) }}" method="POST" style="display: inline-block;">
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
