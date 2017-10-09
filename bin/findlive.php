<?php
require_once __DIR__.'/../vendor/autoload.php';

define('BASE_PATH', __DIR__.'/..');
define('APP_PATH', BASE_PATH.'/App');

require_once __DIR__.'/../bootstrap/app.php';
require_once __DIR__.'/../bootstrap/db.php';

$job = new \App\Job\FindLive($app->getContainer());
$result = $job->execute();
