<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conversation;
use App\Models\Student;
use App\Models\Teacher;

class ConversationController extends Controller
{
    public function index()
    {
        $conversations = Conversation::all();
        return view('conversations.index', compact('conversations'));
    }

    public function create()
    {
        $students = Student::all();
        $teachers = Teacher::all();
        return view('conversations.create', compact('students', 'teachers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'teacher_id' => 'required|exists:teachers,id',
            'conversation_date' => 'required|date',
            'conversation_content' => 'required',
        ]);

        Conversation::create($request->all());

        return redirect()->route('conversations.index')->with('success', 'Conversation created successfully.');
    }

    public function edit(Conversation $conversation)
    {
        $students = Student::all();
        $teachers = Teacher::all();
        return view('conversations.edit', compact('conversation', 'students', 'teachers'));
    }

    public function update(Request $request, Conversation $conversation)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'teacher_id' => 'required|exists:teachers,id',
            'conversation_date' => 'required|date',
            'conversation_content' => 'required',
        ]);

        $conversation->update($request->all());

        return redirect()->route('conversations.index')->with('success', 'Conversation updated successfully.');
    }

    public function destroy(Conversation $conversation)
    {
        $conversation->delete();
        return redirect()->route('conversations.index')->with('success', 'Conversation deleted successfully.');
    }
}
