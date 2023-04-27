<?php


namespace App\Action\Oeuvre;

use App\Domain\Oeuvre\Service\OeuvreView;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class OeuvreViewAllAction
{
    private $oeuvreView;

    public function __construct(OeuvreView $oeuvreView)
    {
        $this->oeuvreView = $oeuvreView;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface      $response
    ): ResponseInterface
    {

        $resultat = $this->oeuvreView->voirOeuvres();

        // Construit la réponse HTTP
        $response->getBody()->write((string)json_encode($resultat));

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
}
