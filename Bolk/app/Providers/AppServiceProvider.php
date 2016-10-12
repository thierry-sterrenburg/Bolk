<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Project;
use App\Windmill;
use App\Component;

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
            $projectsoverview = Project::get();
            $windmilloverview = Windmill::get();
            $componentoverview = Component::get();
            
            $view->with('projectsoverview', $projectsoverview)->with('windmilloverview', $windmilloverview)->with('componentoverview', $componentoverview);
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
