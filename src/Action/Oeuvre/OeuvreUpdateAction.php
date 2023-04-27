<?php

namespace App\Action\Oeuvre;

use App\Domain\Oeuvre\Service\OeuvreUpdate;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class OeuvreUpdateAction
{
    private $oeuvreUpdate;

    public function __construct(OeuvreUpdate $oeuvreUpdate)
    {
        $this->oeuvreUpdate = $oeuvreUpdate;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {

        // Récupération des données du corps de la requête
        $data = (array)$request->getParsedBody();
        // Récupération du paramètre de route 'id'
        $id = $request->getAttribute('id', 0);


        $resultat = $this->oeuvreUpdate->updateOeuvre($id, $data);

        // Construit la réponse HTTP
        $response->getBody()->write((string)json_encode($resultat["oeuvre"]));

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus($resultat["codeStatus"]);
    }
}
