<?php
/**
 * This does the setup for the Eloquent handling
 * outside of Laravel (using capsule)
 */
$dbType = 'mysql';

$dbconfig = [
    'driver'    => $dbType,
    'host'      => $_ENV['DB_HOST'],
    'database'  => $_ENV['DB_NAME'],
    'username'  => $_ENV['DB_USER'],
    'password'  => $_ENV['DB_PASS'],
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
];

$capsule = new Illuminate\Database\Capsule\Manager;
$capsule->addConnection($dbconfig);
$capsule->bootEloquent();
$capsule->setAsGlobal();
