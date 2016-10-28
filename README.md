## Slim Application Skeleton

This project is a basic skeleton of a Slim application that includes:

- Controller support
- Templating via [Twig](http://twig.sensiolabs.org/) views (including layouts)
- A basic file structure for an MVC application
- Database migrations with [Phinx](https://phinx.org/)

### Installation:

To use this project, clone it and point your web server at the `public/` directory as the document root:

```
<VirtualHost *:80>
	ServerName slim-app.localhost
	DocumentRoot /var/www/slim-app/public
	ErrorLog "/var/log/www/slim-app-error_log"
</VirtualHost>
```

Replacing the hostname and `ErrorLog` path as needed.

Then copy over the `.env.example` to `.env` in the base directory. If the installation is successful you should see a "Success!" message when you visit your hostname.


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
