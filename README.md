webmanager
==========

Installer for the database and the first admin user

## Installation
Require this package in your composer.json:

    "raymondidema/webmanager": "dev-master"
    
And add the ServiceProvider to the providers array in app/config/app.php

    'Raymondidema\Webmanager\WebmanagerServiceProvider',

If you like Bootstrap 3.0 you could do the following:

    'php artisan asset:publish raymondidema/webmanager'
    
To edit the company name and e-mail address you should do:

    'php artisan config:publish raymondidema/webmanager'

After this you could edit the config file.

    '/app/packages/raymondidema/webmanager/config.php'
    
