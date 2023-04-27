<?php

namespace App\Action\Oeuvre;

use App\Domain\Oeuvre\Service\OeuvreDelete;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class OeuvreDeleteAction
{
    private $oeuvreDelete;

    public function __construct(OeuvreDelete $oeuvreDelete)
    {
        $this->oeuvreDelete = $oeuvreDelete;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {

        // Récupération du paramètre de route 'id'
        $id = $request->getAttribute('id', 0);

        $resultat = $this->oeuvreDelete->supprimeOeuvre($id);

        // Construit la réponse HTTP
        $response->getBody()->write((string)json_encode($resultat["oeuvre"]));

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus($resultat["codeStatus"]);
    }
}
