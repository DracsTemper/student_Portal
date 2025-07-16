<!DOCTYPE html>
<html>
<head>
    <title>Add Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <h1 class="mb-4">Add New Student</h1>

    <!-- Show validation errors -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> Please fix the following errors:<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Student Form -->
    <form action="{{ route('students.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="roll_number" class="form-label">Roll Number:</label>
            <input type="text" name="roll_number" value="{{ old('roll_number') }}" class="form-control @error('roll_number') is-invalid @enderror">
            @error('roll_number')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Name:</label>
            <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email (optional):</label>
            <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="age" class="form-label">Age:</label>
            <input type="number" name="age" value="{{ old('age') }}" class="form-control @error('age') is-invalid @enderror">
            @error('age')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="bengali" class="form-label">Bengali:</label>
            <input type="number" name="bengali" value="{{ old('bengali') }}" class="form-control @error('bengali') is-invalid @enderror">
            @error('bengali')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="english" class="form-label">English:</label>
            <input type="number" name="english" value="{{ old('english') }}" class="form-control @error('english') is-invalid @enderror">
            @error('english')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="math" class="form-label">Math:</label>
            <input type="number" name="math" value="{{ old('math') }}" class="form-control @error('math') is-invalid @enderror">
            @error('math')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Add Student</button>
        <a href="{{ route('students.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>

</body>
</html>
