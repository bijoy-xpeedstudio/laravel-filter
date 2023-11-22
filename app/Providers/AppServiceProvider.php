<?php

namespace App\Providers;

use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Builder;
use SyntheticRevisions\Models\CustomCollection;

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
        Collection::macro('compare', function () {
            $first = [$this->first()];
            $collection = new CustomCollection($first);
            return $collection->compare();
        });

        // $this->compare();

        // array_map(fn ($module) => array_map(fn ($model) => $model::boot(), ClassFinder::getClassesInNamespace("Modules\\" . $module->getName() . "\\Entities")), Module::all());

    }
}
