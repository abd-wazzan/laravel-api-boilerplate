<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;
use Shared\Enums\MorphEnum;

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
        Relation::morphMap([
            MorphEnum::USER->value => \Domain\Client\Models\User::class,
        ]);

        $this->loadMigrationsFrom([
            database_path() . DIRECTORY_SEPARATOR . 'migrations' . DIRECTORY_SEPARATOR . 'Client',
        ]);

        if ($this->app->isLocal()) {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
    }
}
