<?php

use Slim\App;

return function (App $app) {

    $app->get('/', \App\Action\HomeAction::class)->setName('home');

    // Documentation de l'api
    $app->get('/docs', \App\Action\Docs\SwaggerUiAction::class);

    // Oeuvres
    $app->get('/oeuvres', \App\Action\Oeuvre\OeuvreViewAllAction::class);
    $app->get('/oeuvre', \App\Action\Oeuvre\OeuvreViewAction::class);
    $app->put('/oeuvre', \App\Action\Oeuvre\OeuvreCreateAction::class);
    $app->post('/oeuvre/{id}', \App\Action\Oeuvre\OeuvreUpdateAction::class);
    $app->delete('/oeuvre/{id}', \App\Action\Oeuvre\OeuvreDeleteAction::class);
};

