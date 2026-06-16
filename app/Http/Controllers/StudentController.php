<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\View\View;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $students = Student::query()
            ->when($search, function ($query, $search) {
                $query->where('nis', 'like', "%{$search}%")
                      ->orWhere('name', 'like', "%{$search}%")
                      ->orWhere('class', 'like', "%{$search}%")
                      ->orWhere('major', 'like', "%{$search}%")
                      ->orWhere('phone_number', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");
            })->get();

        return view('student.index', compact('students', 'search'));
    }

    public function create()
    {
        return view('student.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nis' => 'required|string|max:255|unique:students,nis',
            'name' => 'required|string|max:255',
            'class' => 'required|string|max:255',
            'major' => 'required|string|max:255',
            'phone_number' => 'required|string|max:255',
            'email' => 'required|string|max:255|email',
        ]);

        Student::create($validated);
        return redirect()->route('student.index')->with('success', 'Student added successfully');
    }

    public function edit(Student $student)
    {
        return view('student.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'nis' => 'required|string|max:255|unique:students,nis,' . $student->id,
            'name' => 'required|string|max:255',
            'class' => 'required|string|max:255',
            'major' => 'required|string|max:255',
            'phone_number' => 'required|string|max:255',
            'email' => 'required|string|max:255|email',
        ]);

        $student->update($validated);
        return redirect()->route('student.index')->with('success', 'Student updated successfully');
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('student.index')->with('success', 'Student deleted successfully');
    }
}
