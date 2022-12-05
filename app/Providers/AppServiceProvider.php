<?php

namespace App\Providers;

use App\Models\Area;
use App\Models\Category;
use App\Models\Customer;
use App\Models\DayCost;
use App\Models\HomePosters;
use App\Models\InfoUs;
use App\Models\Service;
use App\Models\ServiceProvider as ModelsServiceProvider;
use App\Models\SubCategory;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        $info =InfoUs::first();
        $customer = Customer::where('name' , session('name'))->first();
        $service_provider = ModelsServiceProvider::where('name' , session('name'))->first();
        $categories = Category::orderBy('created_at', 'desc')->get();
        $areas = Area::orderBy('created_at', 'desc')->get();
        $services = Service::orderBy('created_at', 'desc')->get();
        $mostServices = Service::orderBy('created_at', 'desc')->paginate('6');
        $firstServices  = Service::orderby('id')->take(5)->get();
        $subCategory = SubCategory::all();
        $lastCategories  = Category::orderby('id' ,'desc')->take(3)->get();
        $firstCategories  = Category::orderby('id')->take(4)->get();
        $slideCategories  = Category::orderby('id' , 'desc')->take(2)->get();
        $subCategories = SubCategory::all();
        $homePosters = HomePosters::orderby('id', 'desc')->get();
        $dayCost = DayCost::first();
        View::share('info', $info);
        View::share('customer', $customer);
        View::share('service_provider', $service_provider);
        View::share('categories', $categories);
        View::share('services', $services);
        View::share('sub_category', $subCategory);
        View::share('lastCategories', $lastCategories);
        View::share('slideCategories', $slideCategories);
        View::share('firstCategories', $firstCategories);
        View::share('areas', $areas);
        View::share('subCategories', $subCategories);
        View::share('firstServices', $firstServices);
        View::share('mostServices', $mostServices);
        View::share('homePosters', $homePosters);
        View::share('dayCost', $dayCost);
    }
}
 