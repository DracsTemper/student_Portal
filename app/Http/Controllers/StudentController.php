<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    // Display a paginated list of students with search
    public function index(Request $request)
    {
        $query = Student::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('roll_number', 'like', "%$search%")
                  ->orWhere('name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%");
        }

        $students = $query->orderBy('roll_number')->paginate(10);

        return view('students.index', compact('students'));
    }

    // Show the form to create a new student
    public function create()
    {
        return view('students.create');
    }

    // Store a new student
    public function store(Request $request)
    {
        $request->validate([
            'roll_number' => 'required|unique:students',
            'name'        => 'required',
            'email'       => 'nullable|email',
            'age'         => 'required|integer|min:3|max:100',
            'bengali'     => 'required|integer|min:0|max:100',
            'english'     => 'required|integer|min:0|max:100',
            'math'        => 'required|integer|min:0|max:100',
        ]);

        Student::create($request->all());

        return redirect()->route('students.index')->with('success', 'Student added successfully.');
    }

    // Show a single student
    public function show(Student $student)
    {
        return view('students.show', compact('student'));
    }

    // Show the form to edit a student
    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    // Update the student
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'roll_number' => 'required|unique:students,roll_number,' . $student->id,
            'name'        => 'required',
            'email'       => 'nullable|email',
            'age'         => 'required|integer|min:3|max:100',
            'bengali'     => 'required|integer|min:0|max:100',
            'english'     => 'required|integer|min:0|max:100',
            'math'        => 'required|integer|min:0|max:100',
        ]);

        $student->update($request->all());

        return redirect()->route('students.index')->with('success', 'Student updated successfully.');
    }

    // Delete the student
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
    }
}
