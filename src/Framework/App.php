<?php
namespace Framework;

use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class App
{
    public function run(ServerRequestInterface $request): ResponseInterface
    {
        $uri = $request->getUri()->getPath();
        if (!empty($uri) && $uri[-1] === '/') {
            return (new Response())
                ->withStatus(301)
                ->withHeader('Location', substr($uri, 0, -1));
        }

        if (!empty($uri) && $uri === '/blog') {
            return new Response(200, [], '<h2>Bienvenue sur mon blog</h2>');
        }
        return new Response(404, [], '<h1>Erreur 404</h1>');
    }
}
