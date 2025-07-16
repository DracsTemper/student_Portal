<!DOCTYPE html>
<html>
<head>
    <title>Student List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <h1 class="mb-4">Student List</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="mb-3">
        <a href="{{ route('students.create') }}" class="btn btn-success">+ Add New Student</a>
    </div>

    <!-- Search Form -->
    <form method="GET" action="{{ route('students.index') }}" class="row mb-4">
        <div class="col-md-4">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search by roll, name, or email">
        </div>
        <div class="col-md-auto">
            <button class="btn btn-primary" type="submit">Search</button>
            <a href="{{ route('students.index') }}" class="btn btn-secondary">Reset</a>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Roll</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Age</th>
                    <th>Bengali</th>
                    <th>English</th>
                    <th>Math</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($students as $index => $student)
                    <tr>
                        <td>{{ $students->firstItem() + $index }}</td>
                        <td>{{ $student->roll_number }}</td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->email ?? '-' }}</td>
                        <td>{{ $student->age }}</td>
                        <td>{{ $student->bengali }}</td>
                        <td>{{ $student->english }}</td>
                        <td>{{ $student->math }}</td>
                        <td>
                            <a href="{{ route('students.show', $student->id) }}" class="btn btn-sm btn-info">View</a>
                            <a href="{{ route('students.edit', $student->id) }}" class="btn btn-sm btn-primary">Edit</a>
                            <form action="{{ route('students.destroy', $student->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center text-muted">No students found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $students->appends(request()->query())->links() }}
    </div>
</div>

</body>
</html>
