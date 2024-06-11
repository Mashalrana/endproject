<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Resource;
use Illuminate\Http\Request;

class Student extends Resource
{
    public static $model = \App\Models\Student::class;

    public static $title = 'student_name';

    public static $search = [
        'student_id', 'student_name'
    ];

    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'student_id')->sortable(),
            Text::make('Student Name', 'student_name')->sortable()->rules('required', 'max:255'),
            Text::make('Student Address', 'student_address')->rules('required', 'max:255'),
            Text::make('Student Postcode', 'student_postcode')->rules('required', 'max:10'),
            Text::make('Student City', 'student_city')->rules('required', 'max:255'),
            BelongsTo::make('Class', 'class', ClassResource::class),
        ];
    }

    public function filters(Request $request)
    {
        return [];
    }
}
