<?php

namespace Inewtonua\Setting;

use Illuminate\Support\ServiceProvider;

use Inewtonua\Setting\Contracts\SettingContract;
use Inewtonua\Setting\Storage\EloquentStorage;

class SettingServiceProvider extends ServiceProvider
{

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->bind('Setting',Setting::class);

        $this->app->bind(SettingContract::class, EloquentStorage::class);

        $this->mergeConfigFrom(__DIR__.'/../../config/settings.php', 'laravel-settings');

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        if ($this->app->runningInConsole()) {

            $this->publishes([
                __DIR__.'/../config/settings.php' => config_path('laravel-settings.php'),
            ], 'laravel-settings-config');


            $filename = 'create_localized_settings_table.php';
            $this->publishes([
                __DIR__.'/../migrations/'.$filename => database_path('/migrations/'.date('Y_m_d_His', time()).'_'.$filename),
            ], 'laravel-settings-migrations');

        }

    }

}
