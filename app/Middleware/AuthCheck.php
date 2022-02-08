<?php

namespace app\middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class AuthCheck
{
    public function __invoke(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {  
        $response = $handler->handle($request);

        if (array_key_exists('user', $_SESSION)) {
            return $response;
        } else {
            return $response->withHeader('Location', '/login')->withStatus(302);
        }
       
        
    }
}