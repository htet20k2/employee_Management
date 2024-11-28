@extends('admin.home')
@section('content')
    <!-- Table Section -->
    <div class="card card-custom my-4 border-0 shadow-sm">
        <div class="card-header bg-light d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Duty List</h5>
            <!-- Search Box -->
            <form method="get" action="" class="mb-3 w-full">
                <div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="Search..."
                        value="{{ request()->input('search') }}">
                    <button type="submit" class="btn btn-outline-secondary" type="submit" id="button-addon2"><i
                            class="fas fa-search"></i></button>
                </div>
            </form>
            <!-- Create Button -->
            <a href="{{ route('duties.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Create
                Duty</a>
        </div>

        @if (session('success'))
            <div id="auto-fade-alert" class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card-body p-0">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>DutyTime</th>
                        <th>Status</th>
                        <th>Action</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach ($duties as $duty)
                        <tr>
                            <td>{{ ($duties->currentPage() - 1) * $duties->perPage() + $loop->index + 1 }}</td>
                            <td>{{ $duty->duty }}</td>
                            <td>{{ $duty->status }}</td>
                            <td>
                                <a href="{{ route('duties.edit', $duty->id) }}" class="btn btn-sm btn-info"><i
                                        class="fas fa-edit"></i> Edit</a>

                                <!-- Delete Form -->
                                <form action="{{ route('duties.destroy', $duty->id) }}" method="POST"
                                    style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this duty?')">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{ $duties->links() }}
@endsection
<script>
    setTimeout(function() {
        var alertElement = document.getElementById('auto-fade-alert');
        if (alertElement) {
            var alert = new bootstrap.Alert(alertElement);
            alert.close();
        }
    }, 1000);
</script>
