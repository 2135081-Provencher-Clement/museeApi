<?php
// Grandement inspiré par le code de Mathieu Fréchette

namespace App\Middleware;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response;
use App\Domain\Cle\Repository\CleRepository;
class ApiCheckMiddleware
{

    private $repository;

    public function __construct(CleRepository $cleRepository)
    {
        $this->repository = $cleRepository;
    }

    /**
     * Validation d'une clé api
     *
     * @param  ServerRequestInterface  $request PSR-7 request
     * @param  RequestHandler $handler PSR-15 request handler
     *
     * @author Mathieu Fréchette
     *
     * @return Response
     */
    public function __invoke(ServerRequestInterface $request, RequestHandler $handler): Response
    {
        // Authorization : 4325435
        $apiKey = explode(' ', $request->getHeaderLine('Authorization'))[0] ?? '';

        $cleExiste = $this->repository->CleExiste($apiKey);

        if($cleExiste == 0) {
            // On retourne un message d'erreur, la requète ne sera pas exécuter
            $response = new Response();
            $response->getBody()->write(json_encode(["erreur" => "La clé est invalide. Accès non autorisé"]));
            return $response
                ->withStatus(403)
                ->withHeader('Content-Type', 'application/json');
        }

        return $handler->handle($request);
    }
}
