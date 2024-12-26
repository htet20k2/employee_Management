@extends('admin.home')

@section('content')
<div class="container">
    <h1>Casuals</h1>
    <a href="{{ route('casuals.create') }}" class="btn btn-primary mb-3">Add New Casual</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Employee</th>
                <th>For Month</th>
                <th>For Year</th>
                <th>Count</th>
                <th>Is Training</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($casuals as $casual)
                <tr>
                    <td>{{ $casual->id }}</td>
                    <td>{{ $casual->employee->name ?? 'N/A' }}</td>
                    <td>{{ \Carbon\Carbon::parse($casual->formonth)->format('F Y') }}</td>
                    <td>{{ $casual->foryear }}</td>
                    <td>{{ $casual->count }}</td>
                    <td>{{ $casual->istraining }}</td>
                    <td>
                        <a href="{{ route('casuals.edit', $casual->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('casuals.destroy', $casual->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">No casuals found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
