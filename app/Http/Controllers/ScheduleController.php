<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\ClassModel;
use App\Models\Subject;
use App\Models\Teacher;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::all();
        return view('schedules.index', compact('schedules'));
    }

    public function create()
    {
        $classes = ClassModel::all();
        $subjects = Subject::all();
        $teachers = Teacher::all();
        return view('schedules.create', compact('classes', 'subjects', 'teachers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'class_id' => 'required|exists:classes,id',
            'subject_id' => 'required|exists:subjects,id',
            'teacher_id' => 'required|exists:teachers,id',
            'schedule_datetime' => 'required|date_format:Y-m-d H:i:s',
        ]);

        $scheduleDatetime = \Carbon\Carbon::createFromFormat('d-m-Y H:i:s', $request->input('schedule_datetime'))->format('Y-m-d H:i:s');

        $schedule = new Schedule();
        $schedule->class_id = $request->input('class_id');
        $schedule->subject_id = $request->input('subject_id');
        $schedule->teacher_id = $request->input('teacher_id');
        $schedule->schedule_datetime = $scheduleDatetime;
        $schedule->save();

        return redirect()->route('schedules.index')->with('success', 'Schedule created successfully.');
    }

    public function edit(Schedule $schedule)
    {
        $classes = ClassModel::all();
        $subjects = Subject::all();
        $teachers = Teacher::all();
        return view('schedules.edit', compact('schedule', 'classes', 'subjects', 'teachers'));
    }

    public function update(Request $request, Schedule $schedule)
    {
        $request->validate([
            'class_id' => 'required|exists:classes,id',
            'subject_id' => 'required|exists:subjects,id',
            'teacher_id' => 'required|exists:teachers,id',
            'schedule_datetime' => 'required|date_format:Y-m-d H:i:s',
        ]);

        $scheduleDatetime = \Carbon\Carbon::createFromFormat('d-m-Y H:i:s', $request->input('schedule_datetime'))->format('Y-m-d H:i:s');

        $schedule->update([
            'class_id' => $request->input('class_id'),
            'subject_id' => $request->input('subject_id'),
            'teacher_id' => $request->input('teacher_id'),
            'schedule_datetime' => $scheduleDatetime,
        ]);

        return redirect()->route('schedules.index')->with('success', 'Schedule updated successfully.');
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        return redirect()->route('schedules.index')->with('success', 'Schedule deleted successfully.');
    }
}
