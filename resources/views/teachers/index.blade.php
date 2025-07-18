@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">Teacher List</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="mb-3">
        <a href="{{ route('teachers.create') }}" class="btn btn-success">+ Add New Teacher</a>
    </div>

    <!-- Search Form -->
    <form method="GET" action="{{ route('teachers.index') }}" class="row mb-4">
        <div class="col-md-4">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search by name or email">
        </div>
        <div class="col-md-auto">
            <button class="btn btn-primary" type="submit">Search</button>
            <a href="{{ route('teachers.index') }}" class="btn btn-secondary">Reset</a>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Age</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($teachers as $index => $teacher)
                    <tr>
                        <td>{{ $teachers->firstItem() + $index }}</td>
                        <td>{{ $teacher->name }}</td>
                        <td>{{ $teacher->email ?? '-' }}</td>
                        <td>{{ $teacher->subject ?? '-' }}</td>
                        <td>{{ $teacher->age }}</td>
                        <td>
                            <a href="{{ route('teachers.show', $teacher->id) }}" class="btn btn-sm btn-info">View</a>
                            <a href="{{ route('teachers.edit', $teacher->id) }}" class="btn btn-sm btn-primary">Edit</a>
                            <form action="{{ route('teachers.destroy', $teacher->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">No teachers found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $teachers->appends(request()->query())->links() }}
    </div>
</div>
@endsection
