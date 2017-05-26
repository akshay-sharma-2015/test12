<?php 
// In src/Middleware/SimpleMiddleware.php
namespace App\Middleware;

class SimpleMiddleware
{
    function __invoke($request, $response, $next)
    {  pr($request);die;
        // If we find /simple/ in the URL return a simple response.
        if (strpos($request->getUri()->getPath(), '/simple/') !== false) {
            $body = $response->getBody();
            $body->write('Thanks!');
            return $response->withStatus(202)
                ->withHeader('Content-Type', 'text/plain')
                ->withBody($body);
        }

        // Calling $next() delegates control to then *next* middleware
        // In your application's queue.
        $response = $next($request, $response);

        // We could further modify the response before returning it.
        return $response;
    }
}
?>