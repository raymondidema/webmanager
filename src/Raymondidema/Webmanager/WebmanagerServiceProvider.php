<?php namespace Raymondidema\Webmanager;

use Illuminate\Support\ServiceProvider;

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
		$app = $this->app;

		$setting = $this->app->make('setting');

		$app['config']->set('database', $setting->get('app.database'));
		$app['config']->set('mail', $setting->get('app.mail'));

		$this->package('raymondidema/webmanager');

		if(file_exists(__DIR__.'/../../routes/routes.php'))
			require(__DIR__.'/../../routes/routes.php');
		

		

		$this->app->before(function() use ($app,$setting)
		{

			if(count($setting->get('install')) == 0)
			{
				$setting->set('install',1);
				$setting->set('install_started','true');
				return $app['redirect']->to('installation');
			};
			// if($app['config']->get('webmanager::install', true))
			// {
			// 	if(!\File::isDirectory(app_path().'/config/production') && !\Session::get('install'))
			// 	{
			// 		return \Redirect::to('installation');
			// 	}
			// };
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
		$this->app->register('Philf\Setting\SettingServiceProvider');
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