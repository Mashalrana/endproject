<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Resource;
use Illuminate\Http\Request;

class Subject extends Resource
{
    public static $model = \App\Models\Subject::class;

    public static $title = 'subject_name';

    public static $search = [
        'id', 'subject_name'
    ];

    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),
            Text::make('Subject Name', 'subject_name')->sortable()->rules('required', 'max:255'),
        ];
    }

    public function filters(Request $request)
    {
        return [];
    }   
}
