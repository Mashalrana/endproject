<?php

namespace App\Providers;

use Laravel\Nova\Menu\MenuGroup;
use Laravel\Nova\Nova;
use Laravel\Nova\Menu\Menu;
use App\Nova\Dashboards\Main;
use Laravel\Nova\Menu\MenuItem;
use Laravel\Nova\Menu\MenuSection;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Events\ServingNova;
use App\Nova\CustomerSupportResource;
use Illuminate\Support\Facades\Blade;
use Visanduma\NovaTwoFactor\Models\TwoFa;
use Laravel\Nova\NovaApplicationServiceProvider;

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
        Nova::footer(function () {
            return Blade::render(
                '<p class="text-center">Made with 💛 by Metis in cooperation with <a class="text-sky-600" href="https://www.codeerbedrijf.nl" target="_blank">LemonLabs  B.V.</a></p>'
            );
        });

        Nova::withoutNotificationCenter();


        Nova::mainMenu(function (\Illuminate\Http\Request $request) {
            $twoFa = TwoFa::where('user_id', $request->user()->id)->first();

            // if ($twoFa && $twoFa->google2fa_enable == 1) {
            //     $return = [
            //         MenuSection::resource(CustomerSupportResource::class)->icon("support"),
            //     ];
            // }

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

            return $return;
        });

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
        return [Main::make()->showRefreshButton()];
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
