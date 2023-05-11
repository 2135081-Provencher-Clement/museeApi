<?php

namespace App\Action\Cle;

use App\Domain\Cle\Service\CleGet;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Psr7\Response;

final class CleGetAction
{
    private $cleGet;

    public function __construct(CleGet $cleGet)
    {
        $this->cleGet = $cleGet;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface      $response
    ): ResponseInterface
    {

        $data = (array)$request->getParsedBody();

        $validUser = $this->cleGet->UserVerify($data['username'], $data['password']);

        if ($validUser) {

            $nouvelleCle = '';

            // Créé une nouvelle clé de 7 chiffres aléatoires
            for($i = 0; $i < 7; $i++) {
                $nouvelleCle .= mt_rand(0, 9);
            }

            $cleInseree = $this->cleGet->InsertNewKeyToUser($data['username'], $nouvelleCle);

            // Le changement à réussi, on retourne la clé
            if ($cleInseree) {

                $response->getBody()->write((string)json_encode(["cle" => $nouvelleCle]));

                return $response
                    ->withHeader('Content-Type', 'application/json')
                    ->withStatus(200);
            }

            $response = new Response();
            $response->getBody()->write(json_encode(["erreur" => "la clé n'a pu être enregistrée dans la base de données"]));

            return $response
                ->withStatus(500)
                ->withHeader('Content-Type', 'application/json');
        }

        $response = new Response();
        $response->getBody()->write(json_encode(["erreur" => "l'usager n'existe pas"]));

        return $response
            ->withStatus(401)
            ->withHeader('Content-Type', 'application/json');
    }
}
