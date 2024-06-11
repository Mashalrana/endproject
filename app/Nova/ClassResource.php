<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Resource;
use Illuminate\Http\Request;

class ClassResource extends Resource
{
    public static $model = \App\Models\ClassModel::class;

    public static $title = 'class_name';

    public static $search = [
        'id', 'class_name'
    ];

    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),
            Text::make('Class Name', 'class_name')->sortable()->rules('required', 'max:255'),
            BelongsTo::make('Mentor', 'mentor', Teacher::class),
            HasMany::make('Students', 'students', Student::class),
        ];
    }

    public function filters(Request $request)
    {
        return [];
    }
}
