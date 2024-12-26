@extends('admin.home')

@section('content')
<div class="container">
    <h1>Edit PayCode</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('paycodes.update', $paycode->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="code">Code</label>
            <input type="text" name="code" id="code" class="form-control" value="{{ old('code', $paycode->code) }}" required>
        </div>

        <div class="form-group">
            <label for="amount">Amount</label>
            <input type="number" name="amount" id="amount" class="form-control" value="{{ old('amount', $paycode->amount) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update PayCode</button>
    </form>
</div>
@endsection
