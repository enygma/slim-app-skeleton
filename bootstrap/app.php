<?php
$dotenv = new Dotenv\Dotenv(BASE_PATH);
$dotenv->load();

session_save_path(realpath(__DIR__.'/../tmp'));

$key = \Defuse\Crypto\Key::loadFromAsciiSafeString($_ENV['ENC_KEY']);
$handler = new \App\Lib\SessionHandler($key);
session_set_save_handler($handler, true);
ini_set('session.cookie_httponly', true);
ini_set('session.use_strict_mode', true);

session_start();

require_once BASE_PATH.'/vendor/twig/twig/lib/Twig/Autoloader.php';
\Twig_Autoloader::register();

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

// Register the Twig view helper
$container['view'] = function($container) {
    $view = new \App\View\TemplateView(BASE_PATH.'/templates');
    $view['container'] = $container;

    $view->addExtension(new \Slim\Views\TwigExtension(
        $container['router'],
        $container['request']->getUri()
    ));
    return $view;
};

// Register the session helper
$container['session'] = function($container) {
    $session_factory = new \Aura\Session\SessionFactory;
    $session = $session_factory->newInstance($_COOKIE);
    return $session->getSegment('default');
};

// Set up the encryption "helper"
$container['encryption'] = function($container) {
    $key = \Defuse\Crypto\Key::loadFromAsciiSafeString($_ENV['ENC_KEY']);
    return new \App\Lib\EncryptionManager($key);
};
