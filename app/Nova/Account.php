<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Resource;
use Illuminate\Http\Request;

class Account extends Resource
{
    public static $model = \App\Models\Account::class;

    public static $title = 'account_username';

    public static $search = [
        'id', 'account_username', 'role'
    ];

    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),
            Text::make('Username', 'account_username')->sortable()->rules('required', 'max:255'),
            Password::make('Password', 'account_password')->rules('required', 'max:255'),
            Select::make('Role', 'role')->options([
                'Manager' => 'Manager',
                'Teacher' => 'Teacher',
                'Student' => 'Student',
            ])->rules('required'),
        ];
    }

    public function filters(Request $request)
    {
        return [];
    }
}
