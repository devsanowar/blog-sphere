<?php

namespace App\Providers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Menu;
use App\Models\Service;
use App\Models\WebsiteSetting;
use App\Models\WebsiteSocialIcon;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Session;
use App\Models\Visitor;
use Illuminate\Support\Facades\Request;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application rooms.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application rooms.
     */
    public function boot(): void
    {
        view()->composer('*', function () {

        });

        Toastr::useVite();

        View::share('website_setting', WebsiteSetting::first());
        View::share('website_social_icons', WebsiteSocialIcon::first());
        View::share('menus', Menu::where('is_active', 1)->get());
        View::share('categories', Category::where('is_active', 1)->get());

        $popularCategories = Category::with(['blogs' => function ($query) {
            $query->select('id', 'category_id', 'views');
        }])
            ->get()
            ->sortByDesc(function ($category) {
                return $category->blogs->sum('views');
            });

        View::share('popularCategories', $popularCategories);

        $popularMenus = Menu::select('id', 'name')
        ->with(['categories.blogs' => function ($query) {
            $query->select('id', 'category_id', 'views');
        }])
            ->get()
            ->sortByDesc(function ($menu) {
                return $menu->categories->flatMap->blogs->sum('views');
            });

        View::share('popularMenus', $popularMenus);

    }
}
