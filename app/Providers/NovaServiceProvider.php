<?php

namespace App\Providers;

use Laravel\Nova\Nova;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\NovaApplicationServiceProvider;
use Visanduma\NovaTwoFactor\Models\TwoFa;
use Laravel\Nova\Menu\MenuGroup;
use Laravel\Nova\Menu\Menu;
use Laravel\Nova\Menu\MenuItem;
use Laravel\Nova\Menu\MenuSection;
use Laravel\Nova\Events\ServingNova;
use Illuminate\Support\Facades\Blade;
use App\Nova\Dashboards\Main;
use App\Nova\Manager;
use App\Nova\Account;
use App\Nova\Teacher;
use App\Nova\ClassResource;
use App\Nova\Student;
use App\Nova\Subject;
use App\Nova\Schedule;
use App\Nova\Conversation;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        // Customize the footer
        Nova::footer(function () {
            return Blade::render(
                '<p class="text-center">Made with 💛 by Metis in cooperation with <a class="text-sky-600" href="https://www.codeerbedrijf.nl" target="_blank">LemonLabs B.V.</a></p>'
            );
        });

        // Disable the notification center
        Nova::withoutNotificationCenter();

        // Customize the main menu
        Nova::mainMenu(function (\Illuminate\Http\Request $request) {
            $twoFa = TwoFa::where('user_id', $request->user()->id)->first();

            $settings = [
                MenuItem::make("Gebruikers", "/resources/users")->icon("users"),
            ];

            $return[] = MenuSection::make("instellingen", [
                MenuGroup::make("Instellingen", $settings),
            ])->icon("cog")
                ->collapsable()
                ->collapsedByDefault();

            $auth = [
                MenuItem::make("Google 2FA", "/nova-two-factor")->icon("lock-closed"),
            ];

            $return[] = MenuSection::make("authenticatie", [
                MenuGroup::make("Google 2FA", $auth),
            ])->icon("lock-closed")
                ->collapsable()
                ->collapsedByDefault();

            $customFunctionalities = [
                MenuItem::resource(Manager::class),
                MenuItem::resource(Account::class),
                MenuItem::resource(Teacher::class),
                MenuItem::resource(ClassResource::class),
                MenuItem::resource(Student::class),
                MenuItem::resource(Subject::class),
                MenuItem::resource(Schedule::class),
                MenuItem::resource(Conversation::class),
            ];

            $return[] = MenuSection::make('Custom Functionalities', [
                MenuGroup::make('Functionalities', $customFunctionalities)
            ])->icon('archive')
                ->collapsable()
                ->collapsedByDefault();

            return $return;
        });

        // Customize the user menu
        Nova::userMenu(function (\Illuminate\Http\Request $request, Menu $menu) {
            $menu->prepend(
                MenuItem::make(
                    "Mijn Profiel",
                    "/admin/resources/users/{$request->user()->getKey()}"
                )
            );

            return $menu;
        });
    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
            ->withAuthenticationRoutes()
            ->withPasswordResetRoutes()
            ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            return $user->role >= 0;
        });
    }

    /**
     * Get the dashboards that should be listed in the Nova sidebar.
     *
     * @return array
     */
    protected function dashboards()
    {
        return [
            new Main(),
        ];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [
            new \Visanduma\NovaTwoFactor\NovaTwoFactor,
        ];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Nova::serving(function (ServingNova $event) {
            $requestedUrl = $_SERVER['REQUEST_URI'];
            $requestMethod = $_SERVER['REQUEST_METHOD'];

            /** @var \App\Models\User|null $user */
            $user = $event->request->user();

            if (is_null($user)) {
                return;
            }

            $twoFa = TwoFa::where('user_id', $user->id)->first();

            if ($twoFa && $twoFa->google2fa_enable) {
                Nova::initialPath("/resources/users");
            } else {
                Nova::initialPath("/admin/nova-two-factor");

                if (!str_contains($requestedUrl, 'nova-two-factor') && !str_contains($requestedUrl, 'nova-api') && $requestMethod === "GET") {
                    abort(code: 302, headers: [
                        'location' => '/admin/nova-two-factor'
                    ]);
                }
            }
        });
    }
}
