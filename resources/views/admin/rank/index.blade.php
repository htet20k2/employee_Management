@extends('admin.home')
@section('content')
    <!-- Table Section -->
    <div class="card shadow-sm border-0">
        <div class="card-header bg-light py-3">
            <div class="row align-items-center">
                <div class="col-md-4">
                    <h5 class="mb-3 md:mb-0">Rank List</h5>
                </div>
                <div class="col-md-4">
                    <!-- Search Box -->
                    {{-- <form method="get" action="" class="mb-0">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Search..."
                                value="{{ request()->input('search') }}">
                            <button class="btn btn-outline-secondary" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form> --}}

                    <form method="get" class="messageBox">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" >
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                          </svg>
                          
                    <input name="search" placeholder="Search..." type="text" id="messageInput" value="{{ request()->input('search') }}" />
                    <button type="submit" id="sendButton">
                        <span>Search</span>
                    </button>
                    </form>
                </div>
                <div class="col-md-4 text-end">
                    <!-- Create Button -->
                    <a href="{{ route('rank.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus-circle me-1"></i>Create Rank
                    </a>
                </div>
            </div>
        </div>

        @if (session('success'))
            <div id="auto-fade-alert" class="alert alert-success alert-dismissible fade show m-3" role="alert">
                <i class="fas fa-check-circle me-1"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Rank</th>
                            <th>Created At</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rank as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->rank }}</td>
                            <td>{{ $item->created_at->format('d M Y') }}</td>
                            <td class="text-center">
                                <div class="d-flex gap-2 justify-content-center">
                                    <a href="{{ route('rank.edit', $item->id) }}" 
                                       class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('rank.destroy', $item->id) }}" 
                                          method="POST" 
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" 
                                                onclick="return confirm('Are you sure you want to delete this rank?')"
                                                data-bs-toggle="tooltip" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">
                                    <i class="fas fa-inbox fa-2x mb-3 d-block"></i>
                                    No ranks found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="card-footer bg-light">
            <div class="d-flex justify-content-end">
                {{ $rank->links() }}
            </div>
        </div>
    </div>
@endsection

@push('styles')
<style>
    .table th, .table td {
        vertical-align: middle;
    }

    .btn-group .btn {
        transition: transform 0.15s ease;
    }

    .btn-group .btn:hover {
        transform: translateY(-1px);
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .card-header .row > div {
            margin-bottom: 1rem;
        }
        .card-header .row > div:last-child {
            margin-bottom: 0;
        }
        .text-end {
            text-align: left !important;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })

    // Auto-hide alert
    setTimeout(function() {
        var alertElement = document.getElementById('auto-fade-alert');
        if (alertElement) {
            var alert = new bootstrap.Alert(alertElement);
            alert.close();
        }
    }, 3000);
</script>
@endpush
