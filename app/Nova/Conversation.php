<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Resource;
use Illuminate\Http\Request;

class Conversation extends Resource
{
    public static $model = \App\Models\Conversation::class;

    public static $title = 'conversation_date';

    public static $search = [
        'id', 'conversation_date'
    ];

    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),
            BelongsTo::make('Student', 'student', Student::class),
            BelongsTo::make('Teacher', 'teacher', Teacher::class),
            Date::make('Conversation Date', 'conversation_date')->rules('required'),
            Textarea::make('Conversation Content', 'conversation_content')->rules('required'),
        ];
    }

    public function filters(Request $request)
    {
        return [];
    }
}
