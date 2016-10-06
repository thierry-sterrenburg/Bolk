<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Project;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('partials.nav', function ($view)
        {
            $projects = Project::pluck('id', 'name');
            $view->with('projects', $projects);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
