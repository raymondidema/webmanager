<?php namespace Raymondidema\Webmanager\Installation;

use DB;
use File;
use Hash;
use Input;
use Config;
use Redirect;
use Validate;
use Philf\Setting\Setting;
use Raymondidema\Webmanager\Models\Install as Install;

/**
 * Install controller
 */
class installController extends \BaseController
{
	protected $rules = [];

	// We need to emulate $this->app;
	#protected $app;

	/**
	 * @todo need to refacture preg_replace code
	 */

	public function postInstall()
	{

		$connectionDetails = Input::all();
		
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

			\App::make('setting')->set('app.database.default','mysql');
			\App::make('setting')->set('app.database.connections',['mysql' => $connection ]);
			\App::make('setting')->set('install_started','false');

			return Redirect::to('installation-step-2');

		} catch(\Exception $e) {

			return Redirect::back()->withInput()->withErrors([['message' => 'Problem with the database connection']]);

		}
		
	}

	public function postInstallStep2()
	{
		// We generate a Users table
		$this->createTable();
		
		$input = Input::all();
		$input['activated'] = 1;
		$input['password'] = Hash::make($input['password']);
		
		// Saving it to the Users table;
		$install = new Install;
		
		$install->create($input);
		
		return Redirect::to('installation-step-3');

	}

	public function createTable()
	{
		$install = new Install;
		$install->table();
	}

	public function postInstallStep3()
	{
		$input = Input::all();
		$email_settings = [
			'driver' => $input['driver'],
			'host' => $input['hostname'],
			'port' => $input['port'],
			'from' => array('address' => $input['fromemail'], 'name' => $input['fromname']),
			'encryption' => $input['encryption'],
			'username' => $input['username'],
			'password' => $input['password'],
			'sendmail' => '/usr/sbin/sendmail -bs',
			'pretend' => false,
		];
		\App::make('setting')->set('app.mail', $email_settings);
		
		$data = [];
		\Config::set('mail',\App::make('setting')->get('app.mail'));

		\Mail::send('hello', $data, function($message)
		{
			$message->to('raymond@design-code.nl','Raymond Idema')
					->subject('Dit is een test');

		});
		echo 'send mailtje';
	}
}