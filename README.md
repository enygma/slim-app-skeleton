# Slim Application Skeleton

This project is a basic skeleton of a Slim application that includes:

- Controller support
- Templating via [Twig](http://twig.sensiolabs.org/) views (including layouts)
- A basic file structure for an MVC application
- Database migrations with [Phinx](https://phinx.org/)
- [Eloquent](https://laravel.com/docs/5.3/eloquent) for working with database models and tables
- Simple encryption using the [Defuse PHP Encryption](https://github.com/defuse/php-encryption) library
- Session security improvements (including encryption)

## Installation:

There are two ways you can install the project and get it up and running: *automated and manual*

### Automated

To use the automated method, execute the `setup.sh` script in the root directory of the project:

```
chmod +x setup.sh
./setup.sh
```

This will ask you a series of questions to set up the application and create the `.env` configuration file to match

### Manual

The manual process goes through the same flow, you just have to do things by hand. Here's the basic steps:

1. Copy the `.env.example` file to `.env`
2. Use your favorite text editor to open the file and update the settings inside to match your configuration
3. Copy over the `phinx.yml.example` file to `phinx.yml`
4. Open it and, in the `development` section update it with your database configuration information (matching what's in `.env`)
5. Use this command to generate an encryption key:

```
php -r 'require_once "vendor/autoload.php"; $key = Defuse\Crypto\Key::createNewRandomKey(); echo $key->saveToAsciiSafeString();'
```

and replace the `ENC_KEY` value with the result
6. Create a `tmp/` directory and `chmod` it:

```
mkdir tmp;
chmod -R 777 tmp;
```

## Hosting the site

### Built-in PHP server

The simplest way to use the skeleton is to just serve it locally with the built-in PHP server. To do this, clone the repository into
a directory and `cd public/`. Once in the public directory, use this command to host the site:

```
php -S localhost:8080
```

This will make the site available on `http://localhost:8080` - if you hit that URL in a browser the

### Hosting with Apache

You can also set up a virtual host to serve the site from an Apache instance. Ensure that `mod_rewrite` is enabled and point your web server at the `public/` directory as the document root:

```
<VirtualHost *:80>
	ServerName slim-app.localhost
	DocumentRoot /var/www/slim-app/public
	ErrorLog "/var/log/www/slim-app-error_log"
</VirtualHost>
```

Be sure to replace the hostname and `ErrorLog` path for your environment.

## Using the Project

Below is information about actually using the project and working with routes, controllers and views.

### Adding a new route

The default installation comes with an example of a simple "index" route you can use for reference but here's a guide to setting up a new controller and all its matching pieces:

#### Create the controller class

The controller class should be created in `App\Controller` with the naming convention `*Controller.php`. So, if you're wanting to add some routes for "Foo" the file should be `App\Controller\FooController.php` and contain the following:

```php
<?php

namespace App\Controller;

class FooController extends \App\Controller\BaseController
{
    public function index()
    {
        return $this->render('/foo/index.php');
    }
}
```

Now we have the controller, lets go add that view and the matching route.

#### Creating the view

In the case of adding a new controller/route, you'll probably want to keep things organized and make a `foo` directory under the `templates\` directory in the base directory. In the controller above we're calling the `index.php` view so lets put this in `templates\foo\index.php`:

```
{% extends 'layouts/main.php' %}

{% block content %}

Foo index view!

{% endblock %}
```

By default the application uses Twig for output templating. In this example we're extending the main layout (in `templates\layouts\main.php`) and adding the content for the "foo" index view.

#### Creating the route

Finally we'll add in the route to connect these two together. Edit the `bootstrap\routes.php` file and add in this:

```php
$app->get('/foo', '\App\Controller\FooController:index');
```

That's all there is to it - now when you visit the `/foo` endpoint on your application you should get the "Foo index view!" content.

### Accessing the session

By default the application also includes session support. You can access this easily in your controllers via the container and the `session` helper property:

```php
<?php

namespace App\Controller;

class IndexController extends \App\Controller\BaseController
{
    public function index()
    {
        $myValue = 'foo';
        // Set the value
        $this->session->set('myvalue', $myValue);

        // Get the value
        $this->session->get('myvalue');

        return $this->render('/index/index.php');
    }
}
```

### Working with models

This skeleton makes use of the encapsulated version of the [Eloquent](https://laravel.com/docs/5.3/eloquent) functionality from the Laravel framework. You can check out the documentation over on the Laravel site for more information.

To create a new model in the skeleton app, you'll need to add a new file in `App\Model` named like your table. For example, if you have a table named `users` you should create a `User` model in `App\Model\User.php`:

```php
<?php

namespace App\Model;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
	/* nothing to see, move along */
}
```

You can then use this model anywhere in your application thanks to the autoloading:

```php
$user = new \App\Model\User();
```

All Eloquent functionality, including relations, works in this system.

### Working with Validation

Also included in the package is the [psecio/validation](https://github.com/psecio/validation) library that can be used for either one-time validation or request validation. It comes included with a request validator for Slim v3 applications that can be easily used in controllers to ensure the information submitted is valid:

```php
<?php

namespace App\Controller;

class IndexController extends \App\Controller\BaseController
{
    public function index($request, $response, $args)
    {
        $data = [];
        $validator = \Psecio\Validation\Validator::getInstance('request.slim3');

        $result = $validator->execute($request, [
            'email' => 'required|email'
        ]);
        if ($result !== true) {
			echo 'fail!';
		}

        return $this->render('/index/index.php', $data);
    }
}
?>
```

The `$request` instance is passed into the validator's `execute()` method and a boolean result shows the status of the tests. You can find out more about using this library [on the GitHub repository for psecio/validation](https://github.com/psecio/validation).

### Data encryption

The skeleton is also equipped with a simple encryption handler making use of the `ENC_KEY` value in the configuration to make it easier to protect data. This handler allows you to encrypt/decrypt string values easily with just two function calls: `encrypt` and `decrypt`. This can be accessed with the `encryption` helper in the controllers:

```php
<?php

namespace App\Controller;

class IndexController extends \App\Controller\BaseController
{
    public function index($request, $response, $args)
    {
		$string = 'this is my string';

		// Encrypt the string for use in the page
		// You can decrypt this data with the $this->encryption->decrypt($data) call
		$data = [
			'string' => $this->encryption->encrypt($string)
		];

		return $this->render('/index/index.php', $data);
	}
}
?>
```
