<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Resource;
use Illuminate\Http\Request;

class Manager extends Resource
{
    public static $model = \App\Models\Manager::class;

    public static $title = 'manager_name';

    public static $search = [
        'manager_id', 'manager_name', 'manager_city'
    ];

    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'manager_id')->sortable(),
            Text::make('Manager Name', 'manager_name')->sortable()->rules('required', 'max:255'),
            Text::make('Address', 'manager_address')->rules('required', 'max:255'),
            Text::make('Postcode', 'manager_postcode')->rules('required', 'max:20'),
            Text::make('City', 'manager_city')->rules('required', 'max:100'),
        ];
    }

    public function filters(Request $request)
    {
        return [];
    }
}
