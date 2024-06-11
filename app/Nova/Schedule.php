<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Resource;
use Illuminate\Http\Request;

class Schedule extends Resource
{
    public static $model = \App\Models\Schedule::class;

    public static $title = 'schedule_datetime';

    public static $search = [
        'id', 'schedule_datetime'
    ];

    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),
            BelongsTo::make('Class', 'class', ClassResource::class),
            BelongsTo::make('Subject', 'subject', Subject::class),
            BelongsTo::make('Teacher', 'teacher', Teacher::class),
            DateTime::make('Schedule Datetime', 'schedule_datetime')->rules('required'),
        ];
    }

    public function filters(Request $request)
    {
        return [];
    }
}
