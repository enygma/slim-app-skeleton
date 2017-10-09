<?php

$app->get('/', '\App\Controller\IndexController:index');
$app->get('/error', '\App\Controller\IndexController:error');

$app->group('/social', function() use ($app) {
    $app->get('', '\App\Controller\SocialController:index');

    $app->get('/twitter', '\App\Controller\SocialController:twitter');
    $app->get('/twitterCallback', '\App\Controller\SocialController:twitterCallback');

    $app->get('/facebook', '\App\Controller\SocialController:facebook');
    $app->get('/facebookCallback', '\App\Controller\SocialController:facebookCallback');

    $app->get('/twitch', '\App\Controller\SocialController:twitch');
    $app->get('/twitchCallback', '\App\Controller\SocialController:twitchCallback');

    $app->delete('/{id}', '\App\Controller\SocialController:delete');
});

$app->group('/user', function() use ($app) {
    $app->get('/dashboard', '\App\Controller\UserController:dashboard');
    $app->get('/logout', '\App\Controller\UserController:logout');
});

$app->group('/watch', function() use ($app) {
    $app->get('', '\App\Controller\WatchController:index');

    $app->get('/create', '\App\Controller\WatchController:create');
    $app->post('/create', '\App\Controller\WatchController:createSubmit');

    $app->delete('/{id}', '\App\Controller\WatchController:delete');
});
