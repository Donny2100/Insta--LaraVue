<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\City;
use App\Models\Language;
use App\Models\Place;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;

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
//        Schema::defaultStringLength(191);
        if (Schema::hasTable('languages')) {
            $languages = Language::query()
                ->where('is_active', Language::STATUS_ACTIVE)
                ->orderBy('is_default', 'desc')
                ->get();

            $language_default = Language::query()
                ->where('is_default', Language::IS_DEFAULT)
                ->first();
        } else {
            $language_default = null;
            $languages = [];
        }

        if (Schema::hasTable('cities')) {
            $destinations = Cache::remember('destinations', 60 * 60, function () {
                return City::query()
                    ->whereHas('places', function($query) {
                        $query->where('status', Place::STATUS_ACTIVE)
                        ->whereHas('owner', function($q) {
                            $q->whereHas('subscriptions', function($q2) {
                                $q2->whereNull('ends_at')
                                ->orWhere('ends_at', '>', \Carbon\Carbon::now());
                            });
                        });
                    })
                    ->limit(10)
                    ->get();
            });

            $popular_search_cities = Cache::remember('popular_search_cities', 60 * 60, function () {
                return City::query()
                    ->has('places')
                    ->inRandomOrder()
                    ->limit(3)
                    ->get();
            });

            $city_count = City::query()
                ->whereHas('places', function($query) {
                    $query->where('status', Place::STATUS_ACTIVE)
                        ->whereHas('owner', function($q) {
                            $q->whereHas('subscriptions', function($q2) {
                                $q2->whereNull('ends_at')
                                ->orWhere('ends_at', '>', \Carbon\Carbon::now());
                            });
                        });
                })
                ->where('status', City::STATUS_ACTIVE)
                ->count();
        } else {
            $city_count = null;
            $destinations = null;
            $popular_search_cities = null;
        }

        if (Schema::hasTable('categories')) {
            $categories = DB::select("
                SELECT
                    categories.id as id
                FROM
                    categories
                INNER JOIN
                    places ON JSON_CONTAINS(places.category->'$[*]', JSON_QUOTE(CAST(`categories`.`id` AS CHAR(50))))
                INNER JOIN
                    users ON places.user_id = users.id
                INNER JOIN
                    subscriptions ON subscriptions.user_id = users.id
                WHERE
                    places.status = 1
                AND
                    subscriptions.ends_at IS NULL OR subscriptions.ends_at > CURRENT_TIMESTAMP
                GROUP BY
                    categories.id;
            ");

            $category_count = count($categories);
        } else {
            $category_count = null;
        }

        if (Schema::hasTable('places')) {
            $place_count = Place::query()
                ->where('status', Place::STATUS_ACTIVE)
                ->whereHas('owner', function($q) {
                    $q->whereHas('subscriptions', function($q2) {
                        $q2->whereNull('ends_at')
                           ->orWhere('ends_at', '>', \Carbon\Carbon::now());
                    });
                })
                ->count();
        } else {
            $place_count = null;
        }

        View::share([
            'destinations' => $destinations,
            'popular_search_cities' => $popular_search_cities,
            'languages' => $languages,
            'language_default' => $language_default,
            'city_count' => $city_count,
            'category_count' => $category_count,
            'place_count' => $place_count,
        ]);
    }
}
