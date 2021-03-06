<?php

namespace hackerESQ\Settings;

use Illuminate\Support\ServiceProvider;
use Route;
use Illuminate\Http\Request;

class SettingsServiceProvider extends ServiceProvider {

	protected $defer = false;

	/**
     * Define routes
     *
     * @return void
     */
    public function boot()
    {

    	/**
         * Publish settings config file
         */
        $this->publishes([
            __DIR__ . '/../config/settings.php' => config_path('settings.php'),
        ], 'config');


        /**
         * Publish settings migration
         */
        $timestamp = date('Y_m_d_His', time());

        $this->publishes([
            __DIR__.'/../database/migrations/create_settings_table.php' => $this->app->databasePath()."/migrations/{$timestamp}_create_settings_table.php",
        ], 'migrations');

    }

	/**
     * Register services.
     *
     * @return void
     */
	public function register () {


		// bind 'settings' to the class named 'settings' in the IOC container
		$this->app->singleton('settings','hackerESQ\Settings\Settings');



	}



}
