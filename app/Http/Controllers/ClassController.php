<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassModel;
use App\Models\Teacher;

class ClassController extends Controller
{
    public function index()
    {
        $classes = ClassModel::all();
        return view('classes.index', compact('classes'));
    }

    public function create()
    {
        $teachers = Teacher::all();
        return view('classes.create', compact('teachers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'class_name' => 'required',
            'mentor_id' => 'required|exists:teachers,id', // Corrected mentor_id field
        ]);

        ClassModel::create($request->all());

        return redirect()->route('classes.index')->with('success', 'Class created successfully.');
    }

    public function edit(ClassModel $class)
    {
        $teachers = Teacher::all();
        return view('classes.edit', compact('class', 'teachers'));
    }

    public function update(Request $request, ClassModel $class)
    {
        $request->validate([
            'class_name' => 'required',
            'mentor_id' => 'required|exists:teachers,id', // Corrected mentor_id field
        ]);

        $class->update($request->all());

        return redirect()->route('classes.index')->with('success', 'Class updated successfully.');
    }

    public function destroy(ClassModel $class)
    {
        $class->delete();
        return redirect()->route('classes.index')->with('success', 'Class deleted successfully.');
    }
}
