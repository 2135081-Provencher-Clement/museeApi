<?php

use Slim\App;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");

return function (App $app) {

    $app->get('/', \App\Action\HomeAction::class)->setName('home');

    // Documentation de l'api
    $app->get('/docs', \App\Action\Docs\SwaggerUiAction::class);

    // Oeuvres
    $app->get('/oeuvres', \App\Action\Oeuvre\OeuvreViewAllAction::class)->add(\App\Middleware\ApiCheckMiddleware::class);
    $app->get('/oeuvre', \App\Action\Oeuvre\OeuvreViewAction::class)->add(\App\Middleware\ApiCheckMiddleware::class);
    $app->put('/oeuvre', \App\Action\Oeuvre\OeuvreCreateAction::class)->add(\App\Middleware\ApiCheckMiddleware::class);
    $app->post('/oeuvre/{id}', \App\Action\Oeuvre\OeuvreUpdateAction::class)->add(\App\Middleware\ApiCheckMiddleware::class);
    $app->delete('/oeuvre/{id}', \App\Action\Oeuvre\OeuvreDeleteAction::class)->add(\App\Middleware\ApiCheckMiddleware::class);

    $app->put('/cle', \App\Action\Cle\CleGetAction::class);
};

