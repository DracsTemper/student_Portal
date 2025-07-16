<!DOCTYPE html>
<html>
<head>
    <title>Student Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <h1 class="mb-4">Student Details</h1>

    <div class="card shadow">
        <div class="card-body">
            <p><strong>Roll Number:</strong> {{ $student->roll_number }}</p>
            <p><strong>Name:</strong> {{ $student->name }}</p>
            <p><strong>Email:</strong> {{ $student->email ?? '-' }}</p>
            <p><strong>Age:</strong> {{ $student->age }}</p>
            <hr>
            <h5 class="mt-3">Subject Results:</h5>
            <p><strong>Bengali:</strong> {{ $student->bengali }}</p>
            <p><strong>English:</strong> {{ $student->english }}</p>
            <p><strong>Math:</strong> {{ $student->math }}</p>
        </div>
    </div>

    <a href="{{ route('students.index') }}" class="btn btn-secondary mt-4">← Back to List</a>
</div>

</body>
</html>
