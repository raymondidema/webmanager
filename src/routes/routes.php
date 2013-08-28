<?php

// This should be run only once!!!

Route::get('installation/{lang?}', function($lang = null)
{
	if($lang != null)
	{
		$setCookie = Cookie::make('lang',$lang,15);
		return Redirect::to('/installation')->withCookie($setCookie);
	}	
	App::setLocale(Cookie::get('lang','en'));
	$file = app_path().'/config/production/database.php';
	if(!File::exists($file))
	{
		return View::make('webmanager::install');
	}
	else
	{
		Log::warning('Someone tried to access the installation dir!');
		return App::abort(404, 'Page not found');
	}
	
});

Route::get('installation-step-2', function()
{
	return View::make('webmanager::installstep2');
});

Route::post('installation', 'Raymondidema\Webmanager\Installation\installController@postInstall');