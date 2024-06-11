<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Resource;
use Illuminate\Http\Request;

class Teacher extends Resource
{
    public static $model = \App\Models\Teacher::class;

    public static $title = 'teacher_name';

    public static $search = [
        'id', 'teacher_name', 'teacher_city'
    ];

    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),
            Text::make('Teacher Name', 'teacher_name')->sortable()->rules('required', 'max:255'),
            Text::make('Address', 'teacher_address')->rules('required', 'max:255'),
            Text::make('Postcode', 'teacher_postcode')->rules('required', 'max:20'),
            Text::make('City', 'teacher_city')->rules('required', 'max:100'),
            HasMany::make('Classes', 'classes', ClassResource::class),
        ];
    }

    public function filters(Request $request)
    {
        return [];
    }
}
