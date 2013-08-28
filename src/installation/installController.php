<?php namespace Raymondidema\Webmanager\Installation;

use DB;
use File;
use Input;
use Config;
use Redirect;
use Raymondidema\Webmanager\Models;

/**
 * Install controller
 */
class installController extends \BaseController
{
	/**
	 * @todo need to refacture preg_replace code
	 */
	public function postInstall()
	{
		$connectionDetails = Input::all();
		#return print_r(Input::all(),1);
		$connection = array(
				'driver'    => 'mysql',
				'host'      => 'localhost',
				'database'  => $connectionDetails['database'],
				'username'  => $connectionDetails['username'],
				'password'  => $connectionDetails['password'],
				'charset'   => 'utf8',
				'collation' => 'utf8_unicode_ci',
				'prefix'    => $connectionDetails['prefix'],
		);
		Config::set('database.connections.testconnection', $connection);
		try {
			DB::connection('testconnection');
			$path = app_path().'/config/production/';
			$connectionData = file_get_contents(__DIR__.'/config_templates/database.php');
			if(!File::isDirectory($path));
				File::makeDirectory($path);
			$connectionData = preg_replace(['*{{(database)}}*','*{{(username)}}*','*{{(password)}}*','*{{(prefix)}}*'],
				[$connectionDetails['database'],$connectionDetails['username'],$connectionDetails['password'],$connectionDetails['prefix']],
				$connectionData);
			File::put($path.'database.php',$connectionData);
			return 'Connection successfull';
		} catch(\Exception $e) {
			return Redirect::back()->withInput()->withErrors([['message' => 'Problem with the database connection']]);
			return 'Error on Database connection'; #die("Could not connect");
		}
		
	}

	public function postInstallStep2()
	{

	}

	public function createTable()
	{
		Install::table();
	}
}