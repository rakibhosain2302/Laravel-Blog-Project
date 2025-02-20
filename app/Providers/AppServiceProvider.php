<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Contract;
use App\Models\Copyright;
use App\Models\Page;
use App\Models\Post;
use App\Models\Slider;
use App\Models\Social;
use App\Models\Titleslogan;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $unreadCount = Contract::where('is_seen', 0)->count();
            $view->with('unreadCount', $unreadCount);
        });

        View::share('slider', Slider::latest()->get());
        View::share('categories', Category::latest()->get());
        View::share('latestPosts', Post::latest()->take(5)->get());
        View::share('copyright', Copyright::get());
        View::share('socialslink', Social::all());
        View::share('titleslogan', Titleslogan::get());
        View::share('navPage', Page::latest()->take(4)->get());
    }
}
