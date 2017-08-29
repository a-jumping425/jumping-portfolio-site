<?php

namespace App\Providers;

use App\Models\Backend\SidebarMenu;
use App\Models\Frontend\TopMenu;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('backend.layouts.sidebar_menu', function ($view) {
            // Get backend sidebar menus
            $sidebarMenu = new SidebarMenu();
            $menus = $sidebarMenu->getHtmlOfMenus();
            $view->with('sidebar_menus', $menus);
        });

        View::composer('frontend.layouts.header', function ($view) {
            // Get frontend top menus
            $topMenu = new TopMenu();
            $menus = $topMenu->getHtmlOfMenus();
            $view->with('top_menus', $menus);
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
