<?php namespace Raymondidema\Webmanager\Models;

use Eloquent;
use Schema;

class Install extends Eloquent
{
	protected $table = 'users';

	public function database()
	{
		Schema::dropIfExists('users');
		Schema::create('users', function($table)
					{
						$table->increments('id');
						$table->string('username')->unique();
						$table->string('email')->unique();
						$table->string('password');
						$table->text('preferences');
						$table->tinyInteger('activated',1)->default(0);
						$table->string('activationCode');
						$table->string('lastKnownIp');
						$table->integer('countLog');
						$table->timestamps();
					});
	}

}