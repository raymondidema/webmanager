<?php namespace Raymondidema\Webmanager;

use Illuminate\Support\ServiceProvider;
use App;
use Cookie;

class WebmanagerServiceProvider extends ServiceProvider {

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
		$this->package('raymondidema/webmanager');
		if(file_exists(__DIR__.'/../../routes/routes.php'))
			require(__DIR__.'/../../routes/routes.php');

		$app = $this->app;

		$this->app->before(function() use ($app)
		{
			if($app['config']->get('webmanager::install', true))
			{
				if(!\File::isDirectory(app_path().'/config/production') && !\Session::get('install'))
				{
					\Session::put('install', true);
					return \Redirect::to('installation');
				}
			};
		});
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('webmanager');
	}

}