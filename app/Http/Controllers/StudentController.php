<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    // Check if user is logged in
    private function checkAuth()
    {
        if (!session('logged_in')) {
            return redirect('/login');
        }
        return null;
    }

    public function index(Request $request)
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $search = $request->input('search');

        $students = Student::with('teacher')
            ->when($search, function ($query, $search) {
                $query->where('roll_number', 'like', "%{$search}%")
                      ->orWhere('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");
            })
            ->orderBy('name')
            ->paginate(10);

        return view('students.index', compact('students'));
    }

    public function show($id)
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $student = Student::findOrFail($id);
        return view('students.show', compact('student'));
    }

    public function create()
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $teachers = \App\Models\Teacher::all(); // Fetch all teachers
        return view('students.create', compact('teachers'));
    }


    public function store(Request $request)
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'teacher_id' => 'nullable|exists:teachers,id'
        ]);

        Student::create($request->all());

        return redirect('/students')->with('success', 'Student created successfully.');
    }

    public function edit($id)
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $student = Student::findOrFail($id);
        $teachers = \App\Models\Teacher::all();
        return view('students.edit', compact('student', 'teachers'));
    }


    public function update(Request $request, $id)
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'teacher_id' => 'nullable|exists:teachers,id'
        ]);

        $student = Student::findOrFail($id);
        $student->update($request->all());

        return redirect('/students')->with('success', 'Student updated successfully.');
    }

    public function destroy($id)
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $student = Student::findOrFail($id);
        $student->delete();

        return redirect('/students')->with('success', 'Student deleted successfully.');
    }
}
