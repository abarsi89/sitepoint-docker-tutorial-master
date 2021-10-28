<?php

namespace Source\Bootstrap;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

class Bootstrap
{
    public function boot(ContainerBuilder $containerBuilder)
    {
        $loader = new XmlFileLoader($containerBuilder, new FileLocator(dirname(__DIR__) . DIRECTORY_SEPARATOR . "config"));

        $loader->load('services.xml');
        $containerBuilder->compile();

        $routes = include dirname(__DIR__) . DIRECTORY_SEPARATOR . "config"  . DIRECTORY_SEPARATOR . "routes.php";

        $uriParts = explode("/", "$_SERVER[REQUEST_URI]");

        $currentRouteName = $uriParts[1];

        if(isset($routes[$currentRouteName])){
            $currentRoute = $routes[$currentRouteName];
            $currentController = $containerBuilder->get($currentRoute);
            $currentController->index();
        }
    }

}

