<?php

namespace Mdeveloper1002\Mframework\Routing;

use Buki\Router\Router as RouterRouter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Routing
{
    private RouterRouter $router;

    public function __construct()
    {
        $this->router = new RouterRouter([
            "paths" => [
                "controllers" => __DIR__ . "/../../app/Controllers",
                "middlewares" => __DIR__ . "/../../app/Middlewares",
            ],
            "namespaces" => [
                "controllers" => "App\\Controllers",
                "middlewares" => "App\\Middlewares",
            ],
        ]);
    }

    public function getRouter(): RouterRouter
    {
        $this->router->notFound(function (Request $request, Response $response) {
            $response->setContent("404 - Page not found");
            $response->setStatusCode(404);
            return $response;
        });
        if ($_ENV["DEBUG"] == "true") {
            $this->router->error(function (Request $request, Response $response, $exception) {
                if ($_ENV["DEBUG"] == "true") {
                    $response->setContent("500 - ERROR msg: => " . $exception->getMessage());
                } else {
                    $response->setContent("500 - Internal server error");
                }
                $response->setStatusCode(500);
                return $response;
            });
        }
        return $this->router;
    }
}