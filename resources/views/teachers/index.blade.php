<!DOCTYPE html>
<html>
<head>
    <title>Teachers</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Teachers List</h2>
        <a href="{{ route('teachers.create') }}" class="btn btn-primary">➕ Add Teacher</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Age</th>
                <th>Email</th>
                <th>Subject</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($teachers as $index => $teacher)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $teacher->name }}</td>
                    <td>{{ $teacher->age }}</td>
                    <td>{{ $teacher->email }}</td>
                    <td>{{ $teacher->subject }}</td>
                    <td>
                        <a href="{{ route('teachers.edit', $teacher->id) }}" class="btn btn-sm btn-warning">✏️ Edit</a>

                        <form action="{{ route('teachers.destroy', $teacher->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">🗑️ Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No teachers found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
</body>
</html>
