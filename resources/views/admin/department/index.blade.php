@extends('admin.home')
@section('content')
    <!-- Table Section -->
    <div class="card card-custom my-4 border-0 shadow-sm">
        <div class="card-header bg-light d-flex flex-wrap justify-content-between align-items-center">
            <h5 class="mb-3 md:mb-0">Department List</h5>
            <!-- Search Box -->
            {{-- <form method="get" action="" class="mb-3 w-full">
                <div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="Search..."
                        value="{{ request()->input('search') }}">
                    <button type="submit" class="btn btn-outline-secondary" type="submit" id="button-addon2"><i
                            class="fas fa-search"></i></button>
                </div>
            </form> --}}

            <form class="messageBox">
                <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" >
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                  </svg>
                  
            <input name="search" placeholder="Search..." type="text" id="messageInput" value="{{ request()->input('search') }}" />
            <button type="submit" id="sendButton">
                <span>Search</span>
            </button>
            </form>

            
            <!-- Create Button -->
            <a href="{{ route('departments.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Create
                Department</a>
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
                        <th>Description</th>
                        <th>Action</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach ($departments as $department)
                        <tr>
                            <td>{{ ($departments->currentPage() - 1) * $departments->perPage() + $loop->index + 1 }}</td>
                            <td>{{ $department->name }}</td>
                            <td>{{ $department->description }}</td>
                            <td>
                                <a href="{{ route('departments.edit', $department->id) }}" class="btn btn-sm btn-info"><i
                                        class="fas fa-edit"></i> Edit</a>

                                <!-- Delete Form -->
                                <form action="{{ route('departments.destroy', $department->id) }}" method="POST"
                                    style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this department?')">
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
    {{ $departments->links() }}
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
