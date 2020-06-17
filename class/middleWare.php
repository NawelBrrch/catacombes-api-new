<?php
namespace Hash\Middleware;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Slim\Handlers\Strategies\RequestResponseArgs;
use Slim\Routing\RouteCollectorProxy;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response as resMid; 

class HeaderMiddleware
{
    // méthode exécutée lorsqu'un objet est utilisé comme une fonction
    public function __invoke(Request $request, RequestHandler $handler)
    {
        // Récupération du contenu de la réponse
        $response = $handler->handle($request);
        $content = $response->getBody();

        // Nouvelle réponse avec une en-tête avant le contenu original
        $response = new resMid();
        $response->getBody();
        header('Content-Type: application/json');

        return $response;
    }
}
