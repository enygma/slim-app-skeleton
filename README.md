# Slim Application Skeleton

This project is a basic skeleton of a Slim application that includes:

- Controller support
- Templating via [Twig](http://twig.sensiolabs.org/) views (including layouts)
- A basic file structure for an MVC application
- Database migrations with [Phinx](https://phinx.org/)

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
