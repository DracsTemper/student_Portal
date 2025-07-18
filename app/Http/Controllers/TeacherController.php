<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;

class TeacherController extends Controller
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

        $teachers = Teacher::query()
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");
            })
            ->orderBy('name')
            ->paginate(10);

        return view('teachers.index', compact('teachers'));
    }

    // Using route model binding
    public function show(Teacher $teacher)
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $teacher->load('students');
        return view('teachers.show', compact('teacher'));
    }

    public function create()
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        return view('teachers.create');
    }

    public function store(Request $request)
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $request->validate([
            'name' => 'required',
            'email' => 'nullable|email|unique:teachers,email',
            'subject' => 'nullable|string',
            'age' => 'nullable|integer|min:0',
        ]);

        Teacher::create($request->all());

        return redirect()->route('teachers.index')->with('success', 'Teacher created successfully.');
    }

    // Route model binding
    public function edit(Teacher $teacher)
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        return view('teachers.edit', compact('teacher'));
    }

    public function update(Request $request, Teacher $teacher)
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $request->validate([
            'name' => 'required',
            'email' => 'nullable|email|unique:teachers,email,' . $teacher->id,
            'subject' => 'nullable|string',
            'age' => 'nullable|integer|min:0',
        ]);

        $teacher->update($request->all());

        return redirect()->route('teachers.index')->with('success', 'Teacher updated successfully.');
    }

    public function destroy(Teacher $teacher)
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $teacher->delete();

        return redirect()->route('teachers.index')->with('success', 'Teacher deleted successfully.');
    }
}
