<?php

namespace App\Action\Oeuvre;

use App\Domain\Oeuvre\Service\OeuvreCreate;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class OeuvreCreateAction
{
    private $oeuvreCreate;

    public function __construct(OeuvreCreate $oeuvreCreate)
    {
        $this->oeuvreCreate = $oeuvreCreate;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {

        // Récupération des données du corps de la requête
        $data = (array)$request->getParsedBody();

        $resultat = $this->oeuvreCreate->creeOeuvre($data);

        // Construit la réponse HTTP
        $response->getBody()->write((string)json_encode($resultat));

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(201);
    }
}
