<?php

namespace App\Providers;
use App\Models\Store;
use App\Models\StoreType;

use Illuminate\Support\ServiceProvider;
use View;

class ViewServiceProvider extends ServiceProvider
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
        View::composer(['sliders.fields'], function ($view) {
            $storeItems = Store::pluck('name_en','id')->toArray();
            $view->with('storeItems', $storeItems);
        });
        View::composer(['stores.fields'], function ($view) {
            $store_typeItems = StoreType::pluck('type_en','id')->toArray();
            $view->with('store_typeItems', $store_typeItems);
        });
        //
    }
}