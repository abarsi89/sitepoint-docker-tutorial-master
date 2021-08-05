<?php

use Source\Router\Router;

function bootstrapYourself($routes)
{
    /**
     * Create a new router instance.
     */
    $router = new Router($_SERVER);


    /**
     * Add a "hello" route that prints to the screen.
     */
    var_dump($router->request);
    var_dump(dirname(__DIR__).DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'routes.php');
    if (array_key_exists($router->request, $routes)) {
        $router->addRoute($router->request, function() {
            $uriParts = explode("/", "$_SERVER[REQUEST_URI]");
            $class = "Source\Controllers\\".ucfirst($uriParts[1]).'Controller';
            var_dump($class);
            $controller = new $class();
//            $containerBuilder = new ContainerBuilder();
//            $containerBuilder->register('mailer', 'Mailer');
            $controller->index();
        });
    }

    /**
     * Run it!
     */
    $router->run();
}

