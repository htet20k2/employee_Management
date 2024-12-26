@extends('admin.home')

@section('content')
<div class="container">
    <h1>Pay Codes</h1>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('paycodes.create') }}" class="btn btn-primary mb-3">Add New PayCode</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Code</th>
                <th>Amount</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($paycodes as $paycode)
                <tr>
                    <td>{{ $paycode->id }}</td>
                    <td>{{ $paycode->code }}</td>
                    <td>{{ $paycode->amount }}</td>
                    <td>
                        <a href="{{ route('paycodes.edit', $paycode->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('paycodes.destroy', $paycode->id) }}" method="POST" style="display: inline-block;">
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
