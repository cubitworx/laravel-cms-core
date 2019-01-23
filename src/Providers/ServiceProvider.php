<?php

namespace Cubitworx\Laravel\Cms\Core\Providers;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider {

	/**
	 * Bootstrap services.
	 *
	 * @return void
	 */
	public function boot() {
		$this->loadMigrationsFrom(__DIR__.'/../migrations');
	}

	/**
	 * Register services.
	 *
	 * @return void
	 */
	public function register() {
		require_once(__DIR__.'/../Helpers/page.php');
	}

}
