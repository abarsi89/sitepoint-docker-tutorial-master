<?php

use Source\Router\Router;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

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

            $containerBuilder = new ContainerBuilder();
            $loader = new XmlFileLoader($containerBuilder, new FileLocator(__DIR__));
            $loader->load('services.xml');

//            require '../libs/Smarty.class.php';
//            $smarty = new Smarty;

            $controller->index();
        });
    }


    $this->containerBuilder = new ContainerBuilder();
    $loader = new XmlFileLoader($this->containerBuilder, new FileLocator(dirname(__DIR__, 3) . DIRECTORY_SEPARATOR . "config"));
    $loader->load('services.xml');
    $this->containerBuilder->compile();

    $smarty = $containerBuilder->get("smarty");

    /**
     * Run it!
     */
    $router->run();
}

