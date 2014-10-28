<?php namespace Sarunas\Gameq;

use Illuminate\Support\ServiceProvider;
use Sarunas\Gameq\Gameq;

class GameqServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('sarunas/gameq');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{

		$this->app['gameq'] = $this->app->share(function($app)
		{
			return new Gameq;
		});


	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('gameq');
	}

}

