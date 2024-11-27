@extends('admin.home')
@section('content')
    <!-- Table Section -->
    <div class="card card-custom my-4 border-0 shadow-sm">
        <div class="card-header bg-light d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Branch List</h5>
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
            <a href="{{ route('branches.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Create
                Branch</a>
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
                        <th>Name</th>
                        <th>Address</th>
                        <th>Action</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach ($branches as $branch)
                        <tr>
                            <td>{{ ($branches->currentPage() - 1) * $branches->perPage() + $loop->index + 1 }}</td>
                            <td>{{ $branch->name }}</td>
                            <td>{{ $branch->address }}</td>
                            <td>
                                <a href="{{ route('branches.edit', $branch->id) }}" class="btn btn-sm btn-info"><i
                                        class="fas fa-edit"></i> Edit</a>

                                <!-- Delete Form -->
                                <form action="{{ route('branches.destroy', $branch->id) }}" method="POST"
                                    style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this branch?')">
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
    {{ $branches->links() }}
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
