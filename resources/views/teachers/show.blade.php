@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">Teacher Details</h1>

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">{{ $teacher->name }}</h4>
            <p class="card-text"><strong>Email:</strong> {{ $teacher->email ?? 'N/A' }}</p>
            <p class="card-text"><strong>Subject:</strong> {{ $teacher->subject ?? 'N/A' }}</p>
            <p class="card-text"><strong>Age:</strong> {{ $teacher->age }}</p>
        </div>
    </div>

    <div class="mt-5">
        <h3>Assigned Students ({{ $teacher->students->count() }})</h3>

        @if($teacher->students->isEmpty())
            <p>No students assigned to this teacher yet.</p>
        @else
            <table class="table table-bordered table-striped mt-3">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Roll Number</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Age</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($teacher->students as $index => $student)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $student->roll_number }}</td>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->email ?? '-' }}</td>
                            <td>{{ $student->age }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <div class="mt-4">
        <a href="{{ route('teachers.index') }}" class="btn btn-secondary">Back to List</a>
    </div>
</div>
@endsection
