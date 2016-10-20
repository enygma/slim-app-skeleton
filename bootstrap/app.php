<?php
require_once BASE_PATH.'/vendor/twig/twig/lib/Twig/Autoloader.php';
\Twig_Autoloader::register();

$config = [];

$app = new Slim\App();

// Make the custom App autoloader
spl_autoload_register(function($class) {
    $classFile = APP_PATH.'/'.str_replace('\\', '/', $class).'.php';
    if (!is_file($classFile)) {
        throw new \Exception('Cannot load class: '.$class);
    }
    require_once $classFile;
});

// Autoload our controllers into the app container
$container = $app->getContainer();

foreach (new DirectoryIterator(APP_PATH.'/Controller') as $fileInfo) {
    if($fileInfo->isDot()) continue;
    $class = 'App\\Controller\\'.str_replace('.php', '', $fileInfo->getFilename());
    $container[$class] = function($c) use ($class){
        return new $class();
    };
}

$container['view'] = function($container) {
    $view = new \App\View\TemplateView(BASE_PATH.'/templates');
    $view['container'] = $container;

    $view->addExtension(new \Slim\Views\TwigExtension(
        $container['router'],
        $container['request']->getUri()
    ));
    return $view;
};
