@extends('admin.home')
@section('content')
    <!-- Table Section -->
    <div class="card card-custom my-4 border-0 shadow-sm">
        <div class="card-header bg-light d-flex flex-wrap justify-content-between align-items-center">
            <h5 class="mb-3 md:mb-0">Departemnt Detail List</h5>


            <form method="get" action="{{ route('departmentdetail.index') }}" class="messageBox">
                <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" >
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                  </svg>
                  
            <input name="search" placeholder="Search..." type="text" id="messageInput"  value="{{ request()->input('search') }}" />
            <button type="submit" id="sendButton">
                <span>Search</span>
            </button>
            </form>
            
            
            <!-- Create Button -->
            <a href="{{ route('departmentdetail.create') }}" class="btn btn-sm  btn-primary"><i class="fas fa-plus-circle"></i> Create
                Department Detail</a>
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
                        <th>Department Name</th>
                        <th>Rank Name</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($departmentDetails as $departmentDetail)
                        <tr>
                            <td>{{ ($departmentDetails->currentPage() - 1) * $departmentDetails->perPage() + $loop->index + 1 }}</td>
                            

                            <td>{{ $departmentDetail->department->name }}</td>
                            <td>{{ $departmentDetail->rank->rank }}</td>

                            <td>
                                <a href="{{ route('departmentdetail.edit', $departmentDetail->id) }}" class="btn btn-sm btn-info"><i
                                        class="fas fa-edit"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{-- {{ $departmentDetails->links() }} --}}
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
